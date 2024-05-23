package com.example.demo;

import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import com.example.demo.entity.Foods;
import com.example.demo.repository.FoodsCrudRepository;
//SD3E倉富広輝
@SpringBootApplication
public class Kadai04DbAopApplication {

	public static void main(String[] args) {
		SpringApplication.run(Kadai04DbAopApplication.class, args)
			.getBean(Kadai04DbAopApplication.class).execute();
	}

	@Autowired
	FoodsCrudRepository repository;

	private void execute() {
		executeInsert("ラーメン", "麺");
		executeSelect();
		executeFindById(１);
	}

	private void executeInsert(String name, String category) {
		Foods food = new Foods();
		food.setName(name);
		food.setCategory(category);

		food = repository.save(food);
		System.out.println("登録したデータ: " + food);
	}

	private void executeSelect() {
		Iterable<Foods> foods = repository.findAll();
		for (Foods food : foods) {
			System.out.println(food);
		}
	}
	
	private void executeFindById(Integer id) {
		Optional<Foods> result = repository.findById(id);
		System.out.println("Optinal[ " + result.get()+"]");
		
	}
}
