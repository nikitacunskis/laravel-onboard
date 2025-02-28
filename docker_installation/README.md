# Dockerfile for Simple PHP Service

This repository contains a Dockerfile for setting up a simple PHP service. The Docker container provides access to the project scope, making it easy to develop and test PHP applications in a consistent environment.

## Getting Started

### Prerequisites

- Docker installed on your machine

### Building the Docker Image

To build the Docker image, navigate to the directory containing the Dockerfile and run the following command:

```sh
docker build -t simple-php-service .
```

### Running the Container

To run the container, use the following command:

```sh
docker run -d -v /path/to/your/project:/var/www/html -p 8080:80 simple-php-service
```

Replace `/path/to/your/project` with the path to your PHP project.

### Accessing the Service

Once the container is running, you can access the PHP service by navigating to `http://localhost:8080` in your web browser.

## Dockerfile Contents

Below is a brief overview of the Dockerfile used in this project:

```Dockerfile
# Use the official PHP image as the base image
FROM php:7.4-apache

# Copy the project files into the container
COPY . /var/www/html

# Set the working directory
WORKDIR /var/www/html

# Expose port 80
EXPOSE 80
```

## Contributing

If you would like to contribute to this project, please fork the repository and submit a pull request.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.