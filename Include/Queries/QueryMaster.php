<?php	
//queries related to category and subcategory and menu
define("SELECT_CATEGORY",'SELECT * FROM category');
define("SELECT_CATEGORY_WHICH_ARE_MAPPED","SELECT * FROM category INNER JOIN category_subcategory_mapping ON category_subcategory_mapping.Category = category.ID GROUP BY ID");
define("SELECT_CATEGORY_BY_NAME",'SELECT * FROM category WHERE Name =');


define("INSERT_CATEGORY",'INSERT INTO category(Name) VALUES( ');
define("DELETE_CATEGORY",'DELETE FROM category WHERE ID =');


define("SELECT_SUB_CATEGORY","SELECT * FROM sub_category");
define("SELECT_SUBCATEGORY_BY_TYPE","SELECT * FROM sub_category WHERE ");
define("SELECT_SUB_CATEGORY_FROM_MAPPING","SELECT * FROM category_subcategory_mapping ");
define("SELECT_SUB_CATEGORY_WHICH_ARE_MAPPED","SELECT * FROM sub_category INNER JOIN category_subcategory_mapping ON category_subcategory_mapping.SubCategory = sub_category.ID GROUP BY ID");
define("SELECT_SUB_CATEGORY_WHICH_ARE_NOT_MAPPED","SELECT * FROM sub_category WHERE ID NOT IN(SELECT SubCategory FROM category_subcategory_mapping)");
define("SELECT_SUBCATEGORY",'SELECT ID,Name FROM sub_category Inner Join category_subcategory_mapping ON category_subcategory_mapping.SubCategory = sub_category.ID WHERE Category = ');


define("INSERT_SUB_CATEGORY","INSERT INTO sub_category(Name) VALUES(");
define("DELETE_SUB_CATEGORY",'DELETE FROM sub_category WHERE ID =');

define("DELETE_CATEGORY_SUBCATEGORY_BY_CATEGORY","DELETE FROM category_subcategory_mapping WHERE ");
define("SELECT_CAT_SUBCAT_MAPPING","SELECT * FROM category_subcategory_mapping WHERE ");
define("SELECT_FROM_ITEM_MAPPING","SELECT * FROM item_mapping WHERE ");
define("INSERT_ITEM_MAPPING","INSERT INTO item_mapping VALUES(");
define("INSERT_MAPPING","INSERT INTO category_subcategory_mapping (Category,SubCategory) VALUES(");


define("SELECT_ALL_ITEM","SELECT * from items");
define("SELECT_ALL_ITEM_NOT_MAPPED","SELECT * from items WHERE ID NOT IN (SELECT Item_ID FROM item_mapping	)");
define("INSERT_ITEM","INSERT INTO items VALUES(");
define("DELETE_ITEM","DELETE FROM items WHERE ID=");	

// select items by various types.
define("SELECT_ITEM_BY_ID","SELECT ID,Description,Price,ImagePath,Unit,MinQuantity FROM items WHERE ID = ");

/*offer section*/
define("SELECT_TODAY_OFFER",'SELECT Item_Name  FROM current_offers INNER JOIN category_item_mapping ON category_item_mapping.Mapping_ID = current_offers.Mapping_ID INNER JOIN Items ON Items.Item_ID = Category_Item_Mapping.Item_ID WHERE  = ');

define("SELECT_CATEGORY_WISE_TAG","SELECT category.Name,category.ID from current_offers INNER JOIN item_mapping ON item_mapping.Item_ID = current_offers.Item_ID 
INNER JOIN category_subcategory_mapping ON category_subcategory_mapping.Mapping_ID = item_mapping.Mapping_ID INNER JOIN category ON category.ID = category_subcategory_mapping.Category GROUP BY category.Name");

define("SELECT_CATEGORY_WISE_OFFER","SELECT ID,ImagePath,Description,Price,Unit,MinQuantity,current_offers.Discount_Percent,current_offers.Off_Rs from items INNER JOIN current_offers ON current_offers.Item_ID = items.ID INNER JOIN item_mapping ON item_mapping.Item_ID = items.ID INNER JOIN category_subcategory_mapping ON category_subcategory_mapping.Mapping_ID = item_mapping.Mapping_ID WHERE category_subcategory_mapping.Category = ");

define("SELECT_EXISTING_OFFERS","SELECT * FROM current_offers");
//define("SELECT_EXISTING_OFFERS","SELECT * FROM current_offers WHERE From >= ".date("Y/m/d")." AND To <= ".date("Y/m/d")."");
define("SELECT_OFFER_ON_ITEM","SELECT Discount_Percent,Off_Rs FROM current_offers WHERE ");
define("INSERT_OFFER","INSERT INTO current_offers VALUES (");
define("DELETE_OFFER","DELETE FROM current_offers WHERE Item_ID=");

/*Queries related to Item Page..*/
define("SELECT_ITEM_TAG","SELECT Name,ID FROM sub_category WHERE ");
define("SELECT_ITEM_BY_SUBCATEGORY","SELECT ID,ImagePath,Description,Price,Unit,MinQuantity FROM items INNER JOIN item_mapping ON item_mapping.Item_ID = items.ID  INNER JOIN category_subcategory_mapping ON category_subcategory_mapping.Mapping_ID = item_mapping.Mapping_ID WHERE category_subcategory_mapping.SubCategory = ");

//user account related queries
define("SELECT_USER_ACCOUNT_DETAILS_BY_EMAIL","SELECT * FROM users WHERE Email = ");	
define("INSERT_NEW_USER","INSERT INTO users values(");
define("SELECT_USER_ADDRESS","SELECT * FROM user_address WHERE User_ID=");
define("SELECT_USER_ADDRESS_BY_ID","SELECT * FROM user_address WHERE Address_ID=");
define("DELETE_USER_ADDRESS","DELETE FROM user_address WHERE Address_ID=");
define("INSERT_USER_ADDRESS","INSERT INTO user_address ");
define("UPDATE_USER_ADDRESS","UPDATE user_address SET ");
define("SELECT_USER_INFO","SELECT * FROM user_info WHERE User_ID=");
define("INSERT_USER_INFO","INSERT INTO user_info values( ");
define("UPDATE_USER_INFO","UPDATE user_info SET ");
	
	//query for cart and orders...
define("SELECT_ITEM_IN_CART","SELECT * FROM user_cart WHERE ");
define("SELECT_ITEM_IN_CONFIRM_ORDER","SELECT * FROM user_order WHERE ");
define("UPDATE_ITEM_IN_CART","UPDATE user_cart SET ");
define("INSERT_ITEM_IN_CART","INSERT INTO user_cart VALUES ( ");
define("DELETE_ITEM_IN_CART","DELETE FROM user_cart WHERE ");
define("SELECT_ORDER","SELECT * FROM user_order WHERE User_ID=");
define("SELECT_ITEMS_IN_ORDER_ID","SELECT * FROM user_order WHERE ");

//queryies related to order after confirmation.
define("INSERT_ITEM_IN_CONFIRM_ORDER","INSERT INTO user_order VALUES( ");

//queries related to ADMIN SECTION..
define("ADMIN_SELECT_USER","SELECT * FROM user_admin ");

?> 