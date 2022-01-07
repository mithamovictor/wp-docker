# Wordpress with Docker Boilerplate
This is a docker container that has a wordpress setup and theme.

## To setup
Clone the repo.
```
git clone git@github.com:mithamovictor/wp-docker.git
```

Spin up the container using docker-compose
```
docker-compose up -d
```
This will setup and install all necessary dependencies for development of the theme.

To stop the docker container
```
docker-compose down
```

Once the container is running cd into the theme and install node modules
```
npm install
```

To start node run
```
npm start
```

To build css and js run
```
npm run build
```

Developed by [Karungaru Mithamo](https://mithamovictor.github.io)