<?php

namespace HexagonDev\Core\Enums;

enum HttpMethodsEnum: string
{
    case GET = 'get';
    case POST = 'post';
    case PUT = 'put';
    case PATCH = 'patch';
    case DELETE = 'delete';
}