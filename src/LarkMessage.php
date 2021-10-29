<?php

namespace NotificationChannels\Lark;

class LarkMessage
{
    /**
     * The GET parameters of the request.
     *
     * @var array|string|null
     */
    protected $query;

    /**
     * The POST data of the Lark request.
     *
     * @var mixed
     */
    protected $data;

    /**
     * 其他信息（不会发送给第三方）
     *
     * @var mixed
     */
    protected $other;

    /**
     * The headers to send with the request.
     *
     * @var array|null
     */
    protected $headers;

    /**
     * The user agent header.
     *
     * @var string|null
     */
    protected $userAgent;

    /**
     * The Guzzle verify option.
     *
     * @var bool|string
     */
    protected $verify = false;

    /**
     * @param mixed $data
     *
     * @return static
     */
    public static function create($data = '')
    {
        return new static($data);
    }

    /**
     * @param mixed $data
     */
    public function __construct($data = '')
    {
        $this->data = $data;
    }

    /**
     * @param mixed $url
     */
    public function url($url = '')
    {
        $this->url = $url;

        return $this;
        
    }

    /**
     * @param mixed $other
     */
    public function other($other = [])
    {
        $this->other = $other;

        return $this;
        
    }

    /**
     * Set the Lark parameters to be URL encoded.
     *
     * @param mixed $query
     *
     * @return $this
     */
    public function query($query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * Set the Lark data to be JSON encoded.
     *
     * @param mixed $data
     *
     * @return $this
     */
    public function data($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Add a Lark request custom header.
     *
     * @param string $name
     * @param string $value
     *
     * @return $this
     */
    public function header($name, $value)
    {
        $this->headers[$name] = $value;

        return $this;
    }

    /**
     * Set the Lark request UserAgent.
     *
     * @param string $userAgent
     *
     * @return $this
     */
    public function userAgent($userAgent)
    {
        $this->headers['User-Agent'] = $userAgent;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'url' => $this->url?? '',
            'query' => $this->query,
            'data' => $this->data,
            'headers' => $this->headers,
            'verify' => $this->verify,
            'other' => $this->other,
        ];
    }
}
