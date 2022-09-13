package bean;

import java.io.Serializable;
import java.sql.Date;

public class Bean implements Serializable {

	private String name;
	private String num;
	private int price;
	private int quantity;
	private Date date;
	private String coment;

	public Bean() {

	}

	//	商品名
	public void setName(String name) {
		this.name = name;
	}

	public String getName() {
		return name;
	}

	//	商品コード
	public void setNum(String num) {
		this.num = num;
	}

	public String getNum() {
		return num;
	}

	//	単価
	public void setPrice(int price) {
		this.price = price;
	}

	public int getPrice() {
		return price;
	}

	//	数量
	public void setQuantity(int quantity) {
		this.quantity = quantity;
	}

	public int getQuantity() {
		return quantity;
	}

	//	年月
	public void setdate(Date date) {
		this.date = date;
	}

	public Date getdate() {
		return date;
	}

	//	コメント
	public void setComent(String coment) {
		this.coment = coment;
	}

	public String getComent() {
		return coment;
	}


}