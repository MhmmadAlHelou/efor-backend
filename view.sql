-- VIEW Items
CREATE OR REPLACE VIEW itemsview AS 
SELECT items.* , categories.* FROM items 
INNER JOIN categories ON items.items_cat = categories.categories_id

-- view favorite
CREATE OR REPLACE VIEW myfavorite AS
SELECT favorite.* , items.* , users.users_id FROM favorite
INNER JOIN users ON users.users_id = favorite.favorite_usersid
INNER JOIN items ON items.items_id = favorite.favorite_itemsid

--cartview
CREATE OR REPLACE VIEW cartview AS
SELECT SUM(items.items_price - items.items_price * items.items_discount / 100) AS itemsprice , COUNT(cart_itemsid) AS countitems , cart.* , items.* FROM cart 
INNER JOIN items ON items.items_id = cart.cart_itemsid
WHERE cart_orders = 0
GROUP BY cart.cart_itemsid , cart.cart_usersid , cart.cart_orders;


--ordersview
CREATE OR REPLACE VIEW ordersview AS
SELECT orders.* , address.* FROM orders
LEFT JOIN address ON address.address_id=orders.orders_address

--ordersdetailsview
CREATE OR REPLACE VIEW ordersdetailsview AS
SELECT SUM(items.items_price - items.items_price * items.items_discount / 100) AS itemsprice , COUNT(cart_itemsid) AS countitems , cart.* , items.* FROM cart 
INNER JOIN items ON items.items_id = cart.cart_itemsid
WHERE cart_orders != 0
GROUP BY cart.cart_itemsid , cart.cart_usersid , cart.cart_orders;

--itemstopselling
CREATE OR REPLACE VIEW itemstopselling AS
SELECT COUNT(cart_id) AS countitems ,cart.* ,items.* ,(items_price - (items_price * items_discount / 100)) AS itemspricediscount FROM cart
INNER JOIN items ON items.items_id = cart.cart_itemsid
WHERE cart_orders != 0
GROUP BY cart_itemsid;