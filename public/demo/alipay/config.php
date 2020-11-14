<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2016101500691006",

		//商户私钥
		'merchant_private_key' => "MIIEpQIBAAKCAQEAt1e4tI3Al6m3xFyAGdmFmJBUJz3b5JUKgpDI7WaAYmmvVv7YUf71ReX6Tae2Lz0jiHaxL5/m2QhVS/4ooZ4ccUokt7WBv3ERwgPis6AcqgmWEOEim9JfNKeY9L8gro8tw2O5EdM5+9rrj14m2i+SfK6FVRFMFMfD1s79Crl8HZ5IaNO2EJnOBOm+qQtlxp0ANOmhZt4WfnmDQsIFtPaJdYab+KVKQtgmBzsl/iEsDencGmmS6y1jT+6dahNss8ZSduWkJMenql4JSjNoQdYBxrdppt3ZKKPinw6BMLTqUv69bcfZ9nQXsZz3KKQasix6o6y+edm4qgwiS3lHT3UKkwIDAQABAoIBAQC1iFvQGlLJWDgmathDwAbxamaIfE1PZOsFIEpyFP2lc7My1h5mAaXlUbKmVRqkZ0rZgXwrBY5S8ldSaRLeA2lyGtGEPGl9nnzQt3wuEqiPC/LUP7Y+xuuRfSiLnPrFG+tZ/VFvfs94uehnCfg6LMREQ6Cs+/Vy1eDovgX6KnHj9/cgzn/w7cmpPeYQw/AgiwHWUf14khRpK2an/Q69px4XPcSrgxT3x8ptZa5fJGDkq/OcR6uzphRODZTflMeA1POONscj17YGtYzZWWrPFwOx+8j0OWuusggdXWb8T6LmOuNwEvReFszP94q96obsm9l2y7OQ5BH5ifLxEBayDJMhAoGBAPM3MErC6967prxfQghsWaD1OngH90928Z0TUKmxwI8vbNai8yDglOt1q112tdUy7NooxvEs+hJofyhXSigDO8edfuFcJSGjPLGo7KQjeT74kT6EZj6+jnPKYyXrX1ig10/ljnbBAVt1/ukS6fYEeWJGbjHuwzCHbubl/sBOwF2JAoGBAMD62442V1AckKjtoM4cUe2Zkihj3cFHxjOTV7ygTIVq3K1Bp9bbJYNgGNqmUpJR/ndXpsg8AwMO3RC8bbKIHA+rZlhhg3PAl8TqJmRD+dpuxgOOlg9dFOiyzF45Ef/6lGbaaGFZtxXO41QvKQ22nNAQJthd1LEgcdVnF5GHIJw7AoGBANx6QSrkvJGzJplI+UFNh4qkA5bgEc9Vkf3EjrDmVBr48P85xJEfRaCVkP0vKfLVMWUq5f2nuiKJ3Auj5bOUCtMP8P82Wuq9Yb3j1nGNPtJY3sH/n/htIhHRfEPZtRtQ4x6oiJcaq7JPqv96h+DfeXIfSrG1MfiCLYTfJisKuNORAoGAELFibpHKybY+2S38+/c9KwVevDmvQ/nWbj2vmDRxihTtU9tbDl3Uh+G3JKrAd8G59k7RsX5ncEtH2hvCjW/ypXRZHQoKWeft+O2cNo4evcNZQ5OA7YFKvrpArWHYacEeNytrXghpquxDg9O0hGgodmL/STYMoOnCjwgk5MTAkGMCgYEAgLbsaR0opyD0VgtQvD4N1jtIdhSiVB7r1fqUym6yq9Pu3U74aUglKPVx99ry9D8h3YD++9C27DdBsSZjhFHMocxRh1bXC3v85qaw4hUCmG+pB1rYlYnm8pSzmDzmmfHozgokYbTkDGlCxnFfRRrsUiEg6qTBXgimUV/IvKGAdTI=",
		//异步通知地址
		'notify_url' => "http://shop.com/api/alipay/notifyurl.html",
		
		//同步跳转
		'return_url' => "http://shop.com/api/alipay/returnurl.html",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAjOLlz+f37spTjz7GuvFa41o8hO0dko+XhwX2u73F3FxJfSfvqf98R83Kl+cImaafJllYa/vtIVSiEyMrGFYYLMUbonKnhNiXYIHO+XCNF+ykDrvPhP68wtV95KanPk52Sns6+dTDmrbXzARXg6Ub1veDOHoyWnYpZb2sdoZ+M0xm9cOyDlwJNUsWmGn5UuX+c2Uthwf5fxEZJPfFqx4ToPA8VXGyxKh50uZMW1tqlevxmYzlVT3P2J5c9/d/KacFd6OFcxH1X0rKDEvVKF4kbf2aTmhSt879jgEMkzbBMErxlNWRRKo4KZjg5a/7IHmRSQn8vvcyFs5YkOEohgo1JQIDAQAB"
);