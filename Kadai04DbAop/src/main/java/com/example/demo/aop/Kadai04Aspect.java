package com.example.demo.aop;

import java.text.SimpleDateFormat;

import org.aspectj.lang.JoinPoint;  // 正しいインポート
import org.aspectj.lang.annotation.Aspect;
import org.aspectj.lang.annotation.Before;
import org.springframework.stereotype.Component;

@Aspect
@Component
public class Kadai04Aspect {

    @Before("execution(* com.example.demo.repository.FoodsCrudRepository.*(..))")  // 修正されたポイントカット式
    public void beforeAdvice(JoinPoint joinPoint) {  // 修正されたタイプ
        System.out.println("=======DB接続======");
        System.out.println(new SimpleDateFormat("yyyy/MM/dd").format(new java.util.Date()));
        System.out.println(String.format("メソッド:%s", joinPoint.getSignature().getName()));
    }
}
