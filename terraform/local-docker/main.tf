terraform {
  required_providers {
    docker = {
      source  = "kreuzwerker/docker"
      version = "~> 3.0"
    }
  }
}

provider "docker" {}

resource "docker_network" "ats_network" {
  name = "ats_terraform_network"
}

resource "docker_image" "nginx" {
  name = "nginx:latest"
}

resource "docker_container" "nginx" {
  name  = "ats_terraform_nginx"
  image = docker_image.nginx.image_id

  ports {
    internal = 80
    external = 8085
  }

  networks_advanced {
    name = docker_network.ats_network.name
  }
}
