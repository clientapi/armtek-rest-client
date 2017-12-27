<?php

namespace ArmtekRestClient\Http\Contracts;

/**
 * Http Response returned from {@see HttpClientInterface::request}.
 *
 * @since 1.0.0
 */
interface ResponseInterface
{
    /**
     * @return int
     */
    public function statusCode();

    /**
     * @return string
     */
    public function contentType();

    /**
     * @return string
     */
    public function content();

    /**
     * @return array
     */
    public function headers();

    /**
     * @param $name
     *
     * @return mixed
     */
    public function header($name);
}
