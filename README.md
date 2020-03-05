# Legendary Artifacts Shop in PHP

We are using dockerized development environment, as described here (almost):
<br/>
http://geekyplatypus.com/dockerise-your-php-application-with-nginx-and-php7-fpm/

The app is going to run locally on http://php-docker.local:8080/

In order to make your machine recognize this address, you should edit your
`/etc/hosts` file.

You may use this simple command in linux terminal:
```
sudo echo "127.0.0.1  php-docker.local" >> /etc/hosts
```

Then install docker & docker-compose, here are some guides:
- Official guide for docker: https://docs.docker.com/install/linux/docker-ce/ubuntu/
- Simplified guide for docker with docker-compose: https://medium.com/@totaku_kun/%D1%83%D1%81%D1%82%D0%B0%D0%BD%D0%BE%D0%B2%D0%BA%D0%B0-docker-%D0%B8-docker-compose-%D0%BD%D0%B0-ubuntu-18-04-fc68de784b4b

Then, once you got docker & docker-compose installed, execute `composer update`
command inside your php docker container using the following command:
```
docker-compose run --rm php composer update
```

And finally, you can run this app, using `docker-compose up`. <br/>
Now just visit http://php-docker.local:8080/ in your browser.
