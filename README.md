Cloudfront Proxies
==================

The bundle automatically register all Cloudfront IP range to the list of the trusted proxies.

The IP range is downloaded from AWS : https://ip-ranges.amazonaws.com/ip-ranges.json

These IPs are cached for one hour by default.

Configuration
-------------

Check the default configuration below.

```yaml
# config/packages/erichard_cloudfront_proxies.yaml

erichard_cloudfront_proxies:
  expire: 3600
  cache: cache.app
  ip_range_url: https://ip-ranges.amazonaws.com/ip-ranges.json
```

Note
----

The IP list is only downloaded when the request contains a `Cloudfront-Forwarded-Proto` header. According to the [AWS documentation](https://docs.aws.amazon.com/AmazonCloudFront/latest/DeveloperGuide/RequestAndResponseBehaviorCustomOrigin.html#request-custom-headers-behavior) this header is not sent by default so you need to configure your Cloudfront distribution properly.

The bundle also take care of setting back the `X-Forwarded-Proto` header based on `Cloudfront-Forwarded-Proto`.

