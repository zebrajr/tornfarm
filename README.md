# tornfarm
To Deploy:
- Set your configuration on docker-compose.yml
- docker-compose up --build
- Login into phpmyadmin and create the database (.src/back/mysql_create_tables)
- Restart the stack - docker-compose down && docker-compose up

To Build:
- Move to Current (cd Current)
- docker build --tag <your-tag:your-version> .


Ps.: Feel free to improve :)
