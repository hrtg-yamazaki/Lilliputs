variable "access_key_id" {}
variable "secret_access_key" {}
variable "db_name" {}
variable "db_user" {}
variable "db_password" {}
variable "app_key" {}
variable "task_role" {}

data "aws_caller_identity" "current" {}

variable "name" {
    type = string
    default = "lilliputs"
}
variable "description" {
    type = string
    default = "for lilliputs"
}


provider "aws" {
    region = "ap-northeast-1"
    access_key = var.access_key_id
    secret_key = var.secret_access_key
}


terraform {
    backend "s3" {
        bucket = "lilliputstf"
        key    = "terraform.tfstate"
        region = "ap-northeast-1"
    }
}
