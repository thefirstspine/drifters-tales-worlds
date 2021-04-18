# Local

```
docker build -f docker/Dockerfile.dev docker -t drifters-tales-worlds
docker run -v {path}\src:/var/www -p 8080:8080 drifters-tales-worlds
```

# Production

```
docker build  -t drifters-tales-worlds
docker run -p 80:8080 drifters-tales-worlds
```
