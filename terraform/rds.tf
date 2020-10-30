##### RDS #####

# terraformがauroraしかサポートしていない?
# ようなので、 AWS console にて作成


##### security group for rds #####

resource "aws_security_group" "lilliputs_db" {
    name = "lilliputs_db"
    vpc_id = aws_vpc.lilliputs.id

    ingress {
        from_port = 3306
        to_port = 3306
        protocol = "TCP"
        cidr_blocks = ["0.0.0.0/0"]

        security_groups = [
            aws_security_group.lilliputs_web.id
        ]
    }

    egress {
        protocol    = "-1"
        from_port   = 0
        to_port     = 0
        cidr_blocks = ["0.0.0.0/0"]
    }
}


##### subnets for rds #####

resource "aws_subnet" "lilliputs_db1" {
    vpc_id = aws_vpc.lilliputs.id
    cidr_block = "10.0.32.0/20"
    availability_zone = "ap-northeast-1a"
}

resource "aws_subnet" "lilliputs_db2" {
    vpc_id = aws_vpc.lilliputs.id
    cidr_block = "10.0.48.0/20"
    availability_zone = "ap-northeast-1c"
}

resource "aws_db_subnet_group" "lilliputs_db" {
    name = "lilliputs_dbsubnet"
    subnet_ids = [
        aws_subnet.lilliputs_db1.id,
        aws_subnet.lilliputs_db2.id
    ]
}

resource "aws_ecs_task_definition" "lilliputs_db" {
    family = "lilliputs-db"
    network_mode = "awsvpc"
    requires_compatibilities = ["FARGATE"]
    cpu = 256
    memory = 512

    execution_role_arn = var.task_role

    container_definitions = file("./json/task_migration.json")
}
