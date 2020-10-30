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
