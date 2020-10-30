##### ECS #####

resource "aws_security_group" "lilliputs_web" {
    name = "lilliputs-web"
    description = "lilliputs-web"
    vpc_id = aws_vpc.lilliputs.id

    ingress {
        from_port = 0
        to_port = 0
        protocol = "-1"

        security_groups = [
            aws_security_group.lilliputs_alb.id,
        ]
    }

    egress {
        from_port = 0
        to_port = 0
        protocol = "-1"
        cidr_blocks = ["0.0.0.0/0"]
    }
}


resource "aws_ecs_cluster" "lilliputs" {
    name = var.name
}


resource "aws_ecs_service" "lilliputs" {
    name = var.name
    cluster = aws_ecs_cluster.lilliputs.id
    desired_count = 1
    launch_type = "FARGATE"

    load_balancer {
        target_group_arn = aws_lb_target_group.lilliputs_http.arn
        container_name = "lilliputs-nginx"
        container_port = "80"
    }

    network_configuration {
        subnets = [
            aws_subnet.lilliputs_pub1.id,
            aws_subnet.lilliputs_pub2.id,
        ]
        security_groups = [
            aws_security_group.lilliputs_alb.id,
            aws_security_group.lilliputs_web.id,
        ]
        assign_public_ip = true
    }

    task_definition = aws_ecs_task_definition.lilliputs.arn
}


resource "aws_ecs_task_definition" "lilliputs" {
    family = "lilliputs"
    network_mode = "awsvpc"
    requires_compatibilities = ["FARGATE"]
    cpu = 256
    memory = 512

    execution_role_arn = var.task_role

    container_definitions = file("./json/task_definitions.json")
}


resource "aws_cloudwatch_log_group" "lilliputs" {
    name = "lilliputs-lg"
}
