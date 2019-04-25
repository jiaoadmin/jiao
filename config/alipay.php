<?php
return [
		//应用ID,您的APPID。
		'app_id' => "2016092600602130",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEogIBAAKCAQEAx5oztzXLdi1B7In0Ojye0Ae5PyXAFhiYkfFVHOtZ/MOpCNuW88r0j6DFK5VBHYtQp3O2mC2NOAY0nX8FesjdiJ0C8SboRvgoIQ1I7MCYGecmdctMMpBK6gVSYzxgBMsMEtCmfLaa5wKfudXVb+B5oLH7Fso3CbpOn+DKxp3L8E/oVWONq3jCXw7yX/2ohN9awPt3Pcip/3TdYk8P7u3WIZM4bmcqZUMXhoRCjC6AgmqwekHIYGWroKKD9o2Tk1/VEwliPOQdp4lMr6JyT5816dUoF5rETnNGFm8STNAAPkZTeFgIqXL5LlH1W/CWZQ3Bxf9F73lowm4RP7vdXNUiiwIDAQABAoIBAHIir/3MigqKeI7sl7YRYfKs5/W+/WblK6EQcc32ml9Z9rd08Y14eX4DvZtdXn2pYzZNiZTdP0pQ6hdBQf3jDCKJPdxtlha24iN8OD4BJzhwn+JtnKWxMtU8s87BAFrdTIsZuonH1S3Rp0oZh1HQ91u3Sk/O08gBO+JaJTmLk8lWtUO+q6KoKKOnOI12oilPtXlZKmfoW7uDCYquEZmAaai7moXoesr2tl3EEC27b6QrT13r47w95dYbHw3JOPd8vIhwAyCuN7X+e/Vxq4txYJtPR6keARGTCSjIcE3hNoDwyZRYTh8B9XqsJIteG6FXkjahDE8C6SH1Ht5Hh5ti3FECgYEA7NX4DgkfI+U8QYusnxHtx2NHR3q6cmVOLAsEvae0tutQEggns4qQrfUhX4zNge+rbEXqDEMlWDK3eahz3M5sMEbI7/Q8IkNzdXzRVpDshyBvv93o9ttnIrGkuYOjq9gI+9L+jamWR6l6pU3vlMiTA/fGG+KgsjR4yFgjk0l7feMCgYEA18DyB7B6e2YaK9WgetBAj0fTbys4N87XiD1M2NewkJF4kYJretj3FZokFnHkrWTJebY609MUlAZ+ZTqw6ToKd3p1MzhXQvlP30YD3UsKA0ODBUr8lSf8OSxCCvnekTk4SmD2hS0EEnTaDPD5PvyX5m3xOZ/9UhTyuyky/y28aTkCgYBlukqADN75Vh+Zr9sHwHW37SbSxx6KwIThWiJBLGXtJAoSlLoo3l3iuqYJGruzEjU5npY3iifiSHaSpQ6PS4MhAWaR2wBxXzOaxXBNlJZkPESDz1efoQId3tv4a1jEGVlSgYChbLSGN3/cvSspZzXuwGCx3ZhUs0EmHOW7ABcxLQKBgGJKu7j3FIXdWTT5KRhqgc8E2PV/iigaqqSd0MHFWeIy8+vOr+qSp9aGl8RF9PltvkAd3iUct/ZMEw9JMsm+MICIIJbKJy8S5+l/O0l440HjYvBpXjMRuV3OpPPdLCGbIOL507WOcZl69NAKhHLGnulS0x/+nGjltEPCHEKW8ow5AoGALaf6/UDNH0/T7WUO162gxE+wr4VJyWBy5LN5KFnWwInQk0kSzCVoIPPxtjswjbo3fQb/Ysu+D7f0faWkFROSgQ8XbqpkefRLju2TsG40u8+9hwbzmFeC1n4pXxduWIHR3Xy0AvPTjX7LCTlCw5SBLT4K7ODAtxjeQ8e88YdMpbM=",
		
		//异步通知地址
		'notify_url' => "http://shops.com/alipay/notify",
		
		//同步跳转
		'return_url' => "http://shops.com/alipay/return",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAvNCvlHLGYpmpjbpoPoLFg4TlK9izoJD7ELEGmTiRwkCmdXtgyeIrqHq8JCjvjTCfynqrBOghfCBNs3pS3zKb68L9dLqlBKagQH93FMJifSEpeZSyD2euWAoIp5QruYgMHNEtn8VeVmQF/1tp0wPVgKhHfepnGIGOWp/IYZuQD8mcbK6gP4qz1UG1ZjwIuFOekpSkqnHwOpGxnW4ujth4Sa3vtlvtrL+1unpmFWH8N1kNPED/LXu1szNS+EEvDE3YLZmKNwK2SK8oejUy46UUZCWRZJ5aP/6PJ9OB9KeEt0CBxzaMXBUofzTW3uOmHj2owhtziUfC6q6z6ZjK5qWsVwIDAQAB",
		
		//标识沙箱环境
		"mode"=>'dev'
		
	
	];