##### VPC #####

resource "aws_vpc" "lilliputs" {
    cidr_block = "10.0.0.0/16"
    enable_dns_hostnames = true

    tags = {
        Name = "lilliputs"
    }
}


##### subnet #####

resource "aws_subnet" "lilliputs_pub1" {
    vpc_id = aws_vpc.lilliputs.id

    cidr_block = "10.0.0.0/24"
    availability_zone = "ap-northeast-1a"
}

resource "aws_subnet" "lilliputs_pub2" {
    vpc_id = aws_vpc.lilliputs.id

    cidr_block = "10.0.16.0/24"
    availability_zone = "ap-northeast-1c"
}


##### internet_gateway #####

resource "aws_internet_gateway" "lilliputs_ig" {
    vpc_id = aws_vpc.lilliputs.id
}


##### route #####

resource "aws_route_table" "lilliputs_pub" {
    vpc_id = aws_vpc.lilliputs.id
}

resource "aws_route_table_association" "lilliputs_pub1" {
    subnet_id = aws_subnet.lilliputs_pub1.id
    route_table_id = aws_route_table.lilliputs_pub.id
}

resource "aws_route_table_association" "lilliputs_pub2" {
    subnet_id = aws_subnet.lilliputs_pub2.id
    route_table_id = aws_route_table.lilliputs_pub.id
}

resource "aws_route" "public_route" {
    route_table_id = aws_route_table.lilliputs_pub.id
    destination_cidr_block = "0.0.0.0/0"
    gateway_id = aws_internet_gateway.lilliputs_ig.id
}
