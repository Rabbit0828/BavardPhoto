package com.example.demo.repository;

import org.springframework.data.repository.CrudRepository;
import com.example.demo.entity.Foods;
public interface FoodsCrudRepository extends CrudRepository<Foods, Integer> {

}
