-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июн 28 2025 г., 10:43
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(30) DEFAULT NULL,
  `product_price` decimal(11,2) DEFAULT NULL,
  `quantity` int(11) NOT NULL CHECK (`quantity` > 0),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(1, 'electronics'),
(2, 'furniture'),
(3, 'clothing'),
(4, 'hobby');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `created_at`) VALUES
(1, 6, '2025-06-26 13:37:45'),
(2, 6, '2025-06-26 13:38:15'),
(3, 6, '2025-06-26 13:47:31'),
(4, 6, '2025-06-26 13:47:50'),
(5, 6, '2025-06-26 13:48:45'),
(6, 6, '2025-06-26 13:51:11'),
(7, 6, '2025-06-26 13:52:46'),
(8, 6, '2025-06-26 13:57:47'),
(9, 6, '2025-06-26 13:58:06'),
(10, 6, '2025-06-26 14:00:14'),
(11, 6, '2025-06-26 14:13:07'),
(12, 6, '2025-06-26 14:16:36'),
(13, 6, '2025-06-26 14:24:23'),
(14, 6, '2025-06-26 14:29:25'),
(15, 6, '2025-06-26 14:45:49'),
(16, 6, '2025-06-26 21:17:53'),
(17, 7, '2025-06-26 21:26:31'),
(18, 6, '2025-06-28 08:41:25');

-- --------------------------------------------------------

--
-- Структура таблицы `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(11,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `product_price`, `quantity`) VALUES
(1, 1, 23, 'Electric Kettle', 29.99, 4),
(2, 1, 24, 'Wooden Dining Chair', 49.50, 1),
(3, 1, 29, 'Women\'s Denim Jacket', 59.95, 1),
(4, 2, 23, 'Electric Kettle', 29.99, 1),
(5, 2, 31, 'Bluetooth Wireless Headphones', 79.99, 1),
(6, 3, 23, 'Electric Kettle', 29.99, 1),
(7, 3, 28, 'Modern Coffee Table', 89.99, 1),
(8, 4, 23, 'Electric Kettle', 29.99, 1),
(9, 4, 30, 'Gardening Tool Kit', 23.75, 4),
(10, 5, 31, 'Bluetooth Wireless Headphones', 79.99, 4),
(11, 6, 23, 'Electric Kettle', 29.99, 8),
(12, 7, 36, 'Gaming Mouse', 25.99, 9),
(13, 8, 23, 'Electric Kettle', 29.99, 1),
(14, 9, 24, 'Wooden Dining Chair', 49.50, 1),
(15, 10, 40, 'Denim Jacket', 59.99, 5),
(16, 11, 24, 'Wooden Dining Chair', 49.50, 1),
(17, 12, 37, 'Bookshelf', 89.00, 82),
(18, 13, 44, 'Yoga Mat', 18.75, 4),
(19, 13, 43, 'Painting Set', 22.99, 1),
(20, 14, 43, 'Painting Set', 22.99, 4),
(21, 15, 31, 'Bluetooth Wireless Headphones', 79.99, 9999),
(22, 15, 26, 'Hobby Paint Set', 15.00, 8888),
(23, 15, 40, 'Denim Jacket', 59.99, 333),
(24, 16, 49, 'sefsef', 99999.00, 1),
(25, 17, 49, 'sefsef', 99999.00, 1),
(26, 18, 23, 'Electric Kettle', 29.99, 1),
(27, 18, 27, 'LED Desk Lamp', 34.99, 1),
(28, 18, 29, 'Women\'s Denim Jacket', 59.95, 1),
(29, 18, 31, 'Bluetooth Wireless Headphones', 79.99, 1),
(30, 18, 50, 'product', 134134.00, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `description`, `price`) VALUES
(23, 'Electric Kettle', 1, '1.5L capacity, stainless steel', 29.99),
(24, 'Wooden Dining Chair', 2, 'Oak finish', 49.50),
(25, 'Men\'s Casual T-Shirt', 3, '100% cotton', 19.99),
(26, 'Hobby Paint Set', 4, '24 colors acrylic paints', 15.00),
(27, 'LED Desk Lamp', 1, 'Adjustable brightness', 34.99),
(28, 'Modern Coffee Table', 2, 'Glass top', 89.99),
(29, 'Women\'s Denim Jacket', 3, 'Size M', 59.95),
(30, 'Gardening Tool Kit', 4, 'Includes 5 pieces', 23.75),
(31, 'Bluetooth Wireless Headphones', 1, '', 79.99),
(32, 'Bookshelf', 2, '5 tiers, walnut color', 120.00),
(33, 'Running Shoes', 3, 'Unisex, size 42', 74.99),
(34, 'Bluetooth Speaker', 1, 'Portable, 10h battery life', 39.99),
(35, 'Smartphone Holder', 1, 'Adjustable, fits all phones', 12.50),
(36, 'Gaming Mouse', 1, 'RGB lights, 6 buttons', 25.99),
(37, 'Bookshelf', 2, '5-tier, oak wood', 89.00),
(38, 'Office Desk', 2, '120x60cm, white', 120.00),
(39, 'Wardrobe Cabinet', 2, '3 doors, mirror included', 199.50),
(40, 'Denim Jacket', 3, 'Unisex, medium size', 59.99),
(41, 'Running Shoes', 3, 'Lightweight, breathable', 45.90),
(42, 'Summer Hat', 3, 'Wide brim, straw material', 15.00),
(43, 'Painting Set', 4, '24 acrylic colors + brushes', 22.99),
(44, 'Yoga Mat', 4, 'Non-slip, 6mm thick', 18.75),
(45, 'Sketchbook', 4, 'A4 size, 120 pages', 9.90),
(46, 'Wireless Earbuds', 1, 'Noise cancelling, case included', 49.99),
(47, 'Recliner Chair', 2, 'Adjustable backrest, leather', 210.00),
(48, 'Winter Coat', 3, 'Insulated, waterproof', 89.99),
(49, 'sefsef', 1, 'jhgfjhgfgjhgfjhgf', 99999.00),
(50, 'product', 2, 'osdpkfpasokfposkfd', 134134.00),
(51, 'prod', 2, 'psdoifspodifpsdoif', 22222222.00);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'user'),
(2, 'moderator'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `test1` varchar(33) DEFAULT NULL,
  `test2` int(11) DEFAULT NULL,
  `test3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `test`
--

INSERT INTO `test` (`id`, `test1`, `test2`, `test3`) VALUES
(1, 'hello', 2, 3),
(2, 'hello', 2, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(9) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `telephone`, `password`, `role_id`) VALUES
(3, 'sefsef', 'sefsefsef', 'semo.suslo@gmail.com', '32434234', '$2y$10$TT1z8t9C9tDOA8izsGKcuOmtGlphSlC32CJ9EFcf8mMLCQNSdGdR6', 1),
(5, 'sdfgsdfgsdfg', 'fdsfgsdfg', 'fgdfgdfgdfg@fsdf.co', '234523452345', '$2y$10$I4.m5ltkg8ILAhEyOWqYhus3O.TCeOS13/9X5Mj16JDdeXQk5rqHq', 1),
(6, 'test', 'test', 'test@test.com', '32434234', '$2y$10$JqsRazN1xR2.qvW4jgtoBu0kdRio18XXP/cFcgtijH6iUKCccXirK', 3),
(7, 'user', 'userov', 'user@user.com', '3243423413123', '$2y$10$QdAb.i4nuu7QkoEpVjZYXuq3mur1iI6X.jaQnUeAEsrqVYIoxcV3S', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_product_user` (`product_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
