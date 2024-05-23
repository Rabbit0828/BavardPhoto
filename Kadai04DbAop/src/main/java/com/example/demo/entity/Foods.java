package com.example.demo.entity;

import org.springframework.data.annotation.Id;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@Data
@NoArgsConstructor
@AllArgsConstructor
public class Foods {
@Id
private Integer food_id;

private String food_name;

private String category;
public void setName(String name) {
	this.food_name = name;
}
public void setCategory(String category) {
	this.category = category;
}
}
