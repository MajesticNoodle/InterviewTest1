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

Docker Installation Process using Installer;

1. Double-click Docker Desktop Installer.exe to run the installer.

2. When prompted, ensure the Use WSL 2 instead of Hyper-V option on the Configuration page is selected or not depending on your choice of backend.
    - If your system only supports one of the two options, you will not be able to select which backend to use.

3. Follow the instructions on the installation wizard to authorize the installer and proceed with the install.

4. When the installation is successful, select Close to complete the installation process.

5. If your admin account is different to your user account, you must add the user to the docker-users group. Run Computer Management as an administrator and navigate to Local Users and Groups > Groups > docker-users. Right-click to add the user to the group. Sign out and sign back in for the changes to take effect.

If that doesn't work for some reason, then try the following; 

Using Powershell;

    Start-Process 'Docker Desktop Installer.exe' -Wait install

Using CMD; 

    start /w "" "Docker Desktop Installer.exe" install

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

