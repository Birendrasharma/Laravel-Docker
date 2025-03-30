# Project Setup and Deployment

This project uses **Docker** and **Docker Compose** for easy setup and management of services including the web server, database, and application container.

## Prerequisites

Before setting up the project, ensure you have the following installed on your machine:

- **Docker**: [Download Docker](https://www.docker.com/get-started)
- **Docker Compose**: [Download Docker Compose](https://docs.docker.com/compose/install/)

## Setup Instructions

Follow these steps to set up and run the project using Docker Compose:

### 1. Clone the Repository

Clone the project repository to your local machine:

git clone <repository-url>
cd <project-directory>


### 2. Build and Start Containers
Run the following command to build and start all the services defined in the docker-compose.yml file:

docker compose up -d --build

This command does the following:

Builds the Docker images for each service.

Starts the containers in detached mode (-d), meaning it runs in the background.

### 3. Check Container Status
After running the command, you can verify that all containers are running using the following command:

docker compose ps
This will show a list of running containers.

### 4. Access the Application
The web server will be available at http://localhost:8080.



