-- create and connect to a db before doing the following..

-- Audit

CREATE schema audit;
REVOKE CREATE ON schema audit FROM public;
 
CREATE TABLE audit.logged_actions (
    schema_name text NOT NULL,
    TABLE_NAME text NOT NULL,
    user_name text,
    action_tstamp TIMESTAMP WITH TIME zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    action TEXT NOT NULL CHECK (action IN ('I','D','U')),
    original_data text,
    new_data text,
    query text
) WITH (fillfactor=100);
 
REVOKE ALL ON audit.logged_actions FROM public;
 
GRANT SELECT ON audit.logged_actions TO public;
 
CREATE INDEX logged_actions_schema_table_idx 
ON audit.logged_actions(((schema_name||'.'||TABLE_NAME)::TEXT));
 
CREATE INDEX logged_actions_action_tstamp_idx 
ON audit.logged_actions(action_tstamp);
 
CREATE INDEX logged_actions_action_idx 
ON audit.logged_actions(action);
 
CREATE OR REPLACE FUNCTION audit.if_modified_func() RETURNS TRIGGER AS $body$
DECLARE
    v_old_data TEXT;
    v_new_data TEXT;
BEGIN 
    IF (TG_OP = 'UPDATE') THEN
        v_old_data := ROW(OLD.*);
        v_new_data := ROW(NEW.*);
        INSERT INTO audit.logged_actions (schema_name,table_name,user_name,action,original_data,new_data,query) 
        VALUES (TG_TABLE_SCHEMA::TEXT,TG_TABLE_NAME::TEXT,session_user::TEXT,substring(TG_OP,1,1),v_old_data,v_new_data, current_query());
        RETURN NEW;
    ELSIF (TG_OP = 'DELETE') THEN
        v_old_data := ROW(OLD.*);
        INSERT INTO audit.logged_actions (schema_name,table_name,user_name,action,original_data,query)
        VALUES (TG_TABLE_SCHEMA::TEXT,TG_TABLE_NAME::TEXT,session_user::TEXT,substring(TG_OP,1,1),v_old_data, current_query());
        RETURN OLD;
    ELSIF (TG_OP = 'INSERT') THEN
        v_new_data := ROW(NEW.*);
        INSERT INTO audit.logged_actions (schema_name,table_name,user_name,action,new_data,query)
        VALUES (TG_TABLE_SCHEMA::TEXT,TG_TABLE_NAME::TEXT,session_user::TEXT,substring(TG_OP,1,1),v_new_data, current_query());
        RETURN NEW;
    ELSE
        RAISE WARNING '[AUDIT.IF_MODIFIED_FUNC] - Other action occurred: %, at %',TG_OP,now();
        RETURN NULL;
    END IF;
 
EXCEPTION
    WHEN data_exception THEN
        RAISE WARNING '[AUDIT.IF_MODIFIED_FUNC] - UDF ERROR [DATA EXCEPTION] - SQLSTATE: %, SQLERRM: %',SQLSTATE,SQLERRM;
        RETURN NULL;
    WHEN unique_violation THEN
        RAISE WARNING '[AUDIT.IF_MODIFIED_FUNC] - UDF ERROR [UNIQUE] - SQLSTATE: %, SQLERRM: %',SQLSTATE,SQLERRM;
        RETURN NULL;
    WHEN OTHERS THEN
        RAISE WARNING '[AUDIT.IF_MODIFIED_FUNC] - UDF ERROR [OTHER] - SQLSTATE: %, SQLERRM: %',SQLSTATE,SQLERRM;
        RETURN NULL;
END;
$body$
LANGUAGE plpgsql
SECURITY DEFINER
SET search_path = pg_catalog, audit;

-- DB

create schema db;

create table db.Role (rolename varchar PRIMARY KEY NOT NULL);

create table db.Users (username varchar PRIMARY KEY NOT NULL, password varchar NOT NULL, email varchar NOT NULL, role varchar NOT NULL, FOREIGN KEY (role) references db.Role (rolename));

create table db.Semester (year integer NOT NULL, term varchar NOT NULL, PRIMARY KEY (year, term));

create table db.course (courseid serial PRIMARY KEY NOT NULL, coursename text, section text, semester_year integer, semester_term varchar, username varchar NOT NULL, FOREIGN KEY (username) references db.users (username), FOREIGN KEY (semester_year, semester_term) references db.semester (year, term));

-- Had to add unique constraints for the references below
ALTER TABLE db.course ADD UNIQUE (courseid); 
ALTER TABLE db.users ADD UNIQUE (username); 
ALTER TABLE db.role ADD UNIQUE (rolename); 

create table db.course_memberships (courseid integer NOT NULL, FOREIGN KEY (courseid) references db.course (courseid), username varchar NOT NULL, FOREIGN KEY (username) references db.users (username), rolename varchar NOT NULL, FOREIGN KEY (rolename) references db.role (rolename), PRIMARY KEY (courseid, username));

create table db.course_material (materialid serial PRIMARY KEY NOT NULL, courseid integer NOT NULL, FOREIGN KEY (courseid) references db.course (courseid), path text, filename text, done boolean, username varchar NOT NULL, FOREIGN KEY (username) references db.users (username));

create table db.assignment (assignmentid serial PRIMARY KEY NOT NULL, courseid integer NOT NULL, FOREIGN KEY (courseid) references db.course (courseid), username varchar NOT NULL, FOREIGN KEY (username) references db.users (username), assignmentname text NOT NULL, assignmenttext text NOT NULL);

-- don't need this
-- ALTER table db.assignment DROP column username; -- looks like we do to find out who is the creator of this assignment

create table db.submission (submissionid serial PRIMARY KEY NOT NULL, assignmentid integer NOT NULL, FOREIGN KEY (assignmentid) references db.assignment (assignmentid), username varchar NOT NULL, FOREIGN KEY (username) references db.users (username), done boolean, timestamp timestamp DEFAULT current_timestamp, filetype varchar); 

CREATE INDEX course_id ON db.Assignment USING btree (courseid);

CREATE INDEX assignment_id ON db.Submission USING btree (assignmentid);

-- Triggers

CREATE TRIGGER role_audit AFTER INSERT OR UPDATE OR DELETE ON db.role FOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();

CREATE TRIGGER users_audit AFTER INSERT OR UPDATE OR DELETE ON db.users FOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();

CREATE TRIGGER semester_audit AFTER INSERT OR UPDATE OR DELETE ON db.semester FOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();

CREATE TRIGGER course_audit AFTER INSERT OR UPDATE OR DELETE ON db.course FOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();

CREATE TRIGGER course_memberships_audit AFTER INSERT OR UPDATE OR DELETE ON db.course_memberships FOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();

CREATE TRIGGER course_material_audit AFTER INSERT OR UPDATE OR DELETE ON db.course_material FOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();

CREATE TRIGGER assignment_audit AFTER INSERT OR UPDATE OR DELETE ON db.assignment FOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();

CREATE TRIGGER submission_audit AFTER INSERT OR UPDATE OR DELETE ON db.submission FOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();
