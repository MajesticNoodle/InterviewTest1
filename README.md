# InterviewTest1

Container running base php task manager website/webapp with mysql included.
User/Task manager has CRUD system to manage both users and tasks given to users.
Create Users/Tasks
Read/view Users/Tasks
Update/Edit Users/Tasks
Delete Users Tasks

Assign Tasks to Users when creating or updating/editing the tasks
Tasks and Users are using tables that include pagination and sorting, custom sorting included to view tasks by user
 
## Ports

* 8000 | 8080 phpmyadmin

## Content

* /php/src

## Usage example

Download Docker Desktop | Should include both Docker Engine and Docker Compose : https://www.docker.com/products/docker-desktop/

Then Open Docker and run following command in this root folder where 'docker-compose.yml' is located.
Simplest would be to open this folder with vscode and using the terminal
BUT can be done using powershell and changing directory to this folder.

Once all that is done, run below command.
    docker-compose up

That should start it up.

go to browser and either type or copy paste the following

    localhost:8000
    http://localhost:8000/

    For phpmyadmin
    localhost:8080
    http://localhost:8080/

