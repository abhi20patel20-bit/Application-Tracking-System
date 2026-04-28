terraform {
  required_providers {
    docker = {
      source  = "kreuzwerker/docker"
      version = "~> 3.0"
    }
  }
}

provider "docker" {}

resource "docker_network" "lb_network" {
  name = "ats_lb_network"
}

resource "docker_image" "nginx" {
  name = "nginx:latest"
}

resource "docker_container" "backend_1" {
  name  = "ats_backend_1"
  image = docker_image.nginx.image_id

  networks_advanced {
    name = docker_network.lb_network.name
  }

  command = [
    "sh",
    "-c",
    "echo '<h1>Hello from Backend 1</h1>' > /usr/share/nginx/html/index.html && nginx -g 'daemon off;'"
  ]
}

resource "docker_container" "backend_2" {
  name  = "ats_backend_2"
  image = docker_image.nginx.image_id

  networks_advanced {
    name = docker_network.lb_network.name
  }

  command = [
    "sh",
    "-c",
    "echo '<h1>Hello from Backend 2</h1>' > /usr/share/nginx/html/index.html && nginx -g 'daemon off;'"
  ]
}

resource "docker_container" "load_balancer" {
  name  = "ats_nginx_load_balancer"
  image = docker_image.nginx.image_id

  ports {
    internal = 80
    external = 8085
  }

  volumes {
    host_path      = abspath("${path.module}/nginx.conf")
    container_path = "/etc/nginx/nginx.conf"
    read_only      = true
  }

  networks_advanced {
    name = docker_network.lb_network.name
  }

  depends_on = [
    docker_container.backend_1,
    docker_container.backend_2
  ]
}
