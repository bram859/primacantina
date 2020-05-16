DROP DATABASE IF EXISTS top_2000_v1;
DROP DATABASE IF EXISTS top_2000_v2;
DROP DATABASE IF EXISTS weerstations;
DROP DATABASE IF EXISTS postcode;

CREATE DATABASE top_2000_v1;
CREATE DATABASE top_2000_v2;
CREATE DATABASE weerstations;
CREATE DATABASE postcode;

USE top_2000_v1;
\. sql/top_2000_v1.sql

USE weerstations;
\. sql/weerstations.sql

USE top_2000_v2;
\. sql/top_2000_v2.sql

USE postcode;
\. sql/postcode.sql