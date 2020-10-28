variable "access_key_id" {}
variable "secret_access_key" {}
variable "name" {
    type = string
    default = "lilliputs"
}


provider "aws" {
    region = "ap-northeast-1"
    access_key = var.access_key_id
    secret_key = var.secret_access_key
}

terraform {
    backend "s3" {
        bucket = "lilliputstf"
        key    = "ecr/terraform.tfstate"
        region = "ap-northeast-1"
    }
}


##### ECR #####

resource "aws_ecr_repository" "lilliputs_php" {
    name = "${var.name}_php"
}

resource "aws_ecr_repository" "lilliputs_nginx" {
    name = "${var.name}_nginx"
}
