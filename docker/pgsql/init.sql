CREATE USER habitproject WITH PASSWORD 'habitproject';
CREATE DATABASE habitproject;
GRANT ALL PRIVILEGES ON DATABASE habitproject TO habitproject;
ALTER DATABASE habitproject SET TIMEZONE TO "Europe/Moscow";

CREATE DATABASE test_habitproject;
GRANT ALL PRIVILEGES ON DATABASE test_habitproject TO habitproject;
ALTER DATABASE test_habitproject SET TIMEZONE TO "Europe/Moscow";