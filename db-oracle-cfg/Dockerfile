# Dockerfile
FROM wnameless/oracle-xe-11g-r2

ADD user.sql /docker-entrypoint-initdb.d/
ADD fyp.sql /docker-entrypoint-initdb.d/
ADD z_grant.sql /docker-entrypoint-initdb.d/
