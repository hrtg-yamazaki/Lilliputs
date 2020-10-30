data "aws_route53_zone" "lilliputs" {
    name = var.domain
}


resource "aws_route53_record" "lilliputs" {
    zone_id = data.aws_route53_zone.lilliputs.zone_id
    name    = data.aws_route53_zone.lilliputs.name
    type    = "A"

    alias {
        name = aws_lb.lilliputs_alb.dns_name
        zone_id = aws_lb.lilliputs_alb.zone_id
        evaluate_target_health = true
    }
}


resource "aws_acm_certificate" "lilliputs_cert" {
    domain_name = var.domain
    subject_alternative_names = []
    validation_method = "DNS"
}

resource "aws_route53_record" "lilliputs_acm" {
    zone_id         = data.aws_route53_zone.lilliputs.zone_id

    for_each = {
        for options in aws_acm_certificate.lilliputs_cert.domain_validation_options : options.domain_name => {
            name   = options.resource_record_name
            record = options.resource_record_value
            type   = options.resource_record_type
        }
    }

    allow_overwrite = true
    ttl             = 60

    name            = each.value.name
    type            = each.value.type
    records         = [
        each.value.record
    ]
}


resource "aws_lb_listener" "lilliputs_https" {
    load_balancer_arn = aws_lb.lilliputs_alb.arn
    port     = "443"
    protocol = "HTTPS"

    certificate_arn = aws_acm_certificate.lilliputs_cert.arn

    default_action {
        type             = "forward"
        target_group_arn = aws_lb_target_group.lilliputs_http.arn
    }
}

resource "aws_lb_listener_rule" "http_to_https" {
    listener_arn = aws_lb_listener.lilliputs_http.arn

    priority = 99

    action {
        type = "redirect"

        redirect {
            port        = "443"
            protocol    = "HTTPS"
            status_code = "HTTP_301"
        }
    }

    condition {
        host_header{
            values = [var.domain]
        }
    }
}
