##### security group #####

resource "aws_security_group" "lilliputs_alb" {
    name = "lilliputs_alb"
    description = "80 and 443 for lilliputs"
    vpc_id = aws_vpc.lilliputs.id

    ingress {
        from_port = 80
        to_port = 80
        protocol = "TCP"
        cidr_blocks = ["0.0.0.0/0"]
    }

    egress {
        from_port = 0
        to_port = 0
        protocol = "-1"
        cidr_blocks = ["0.0.0.0/0"]
    }
}


##### Application Load Balancer #####

resource "aws_lb" "lilliputs_alb" {
    name = var.name
    internal = false
    load_balancer_type = "application"

    security_groups = [
        aws_security_group.lilliputs_alb.id
    ]

    subnets = [
        aws_subnet.lilliputs_pub1.id,
        aws_subnet.lilliputs_pub2.id
    ]
}


##### Target Group #####

resource "aws_lb_target_group" "lilliputs_http" {
    name = "lilliputs-http"
    port = 80
    protocol = "HTTP"
    vpc_id = aws_vpc.lilliputs.id
    target_type = "ip"

    health_check {
        port = 443
        path = "/"
    }

    depends_on = [
        aws_lb.lilliputs_alb
    ]
}


##### Listener #####

resource "aws_lb_listener" "lilliputs_http" {
    load_balancer_arn = aws_lb.lilliputs_alb.arn
    port = "80"
    protocol = "HTTP"

    default_action {
        target_group_arn = aws_lb_target_group.lilliputs_http.arn
        type = "forward"
    }
}
