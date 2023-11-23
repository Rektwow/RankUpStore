-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220626.78b2c1f4eb
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 12. Jul 2022 um 23:38
-- Server-Version: 10.4.24-MariaDB
-- PHP-Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `myname`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'Admin', 'admin@rank.up', '$2y$10$PRmYdKGW6TId/jcG9oHSyunqQS2G1DR9BFOt95lnrRccO.cZPSZxK');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(1, 'Lenovo'),
(2, 'Msi'),
(3, 'Acer'),
(4, 'Razer'),
(5, 'Corsair'),
(6, 'Nvidia'),
(7, 'Apple');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`) VALUES
(1, 'Pc'),
(2, 'Notebook'),
(3, 'Graphics Card'),
(4, 'Equipment'),
(5, 'Ram'),
(6, 'Processor');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `invoice_nr` int(11) NOT NULL,
  `total_products` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `amount`, `invoice_nr`, `total_products`, `order_date`, `order_status`) VALUES
(1, 1, '6380', 1048125930, 3, '2022-07-12 21:32:04', 'pending'),
(2, 1, '3060', 558255702, 3, '2022-07-12 21:33:01', 'Completed'),
(3, 1, '26100', 1316741115, 3, '2022-07-12 21:32:46', 'pending'),
(4, 1, '5560', 1917616825, 4, '2022-07-12 21:34:13', 'Completed'),
(5, 1, '25560', 1829410556, 3, '2022-07-12 21:34:29', 'pending'),
(6, 2, '3550', 1174605220, 2, '2022-07-12 21:37:19', 'pending'),
(7, 2, '12600', 941599726, 1, '2022-07-12 21:37:40', 'Completed');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_nr` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `payments`
--

INSERT INTO `payments` (`payment_id`, `order_id`, `invoice_nr`, `amount`, `payment_mode`, `payment_date`) VALUES
(1, 2, 558255702, '3060', 'Paypal', '2022-07-12 21:33:01'),
(2, 4, 1917616825, '5560', 'MasterCard', '2022-07-12 21:34:13'),
(3, 7, 941599726, '12600', 'Visa', '2022-07-12 21:37:40');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pending`
--

CREATE TABLE `pending` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_nr` int(11) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `pending`
--

INSERT INTO `pending` (`order_id`, `user_id`, `invoice_nr`, `order_status`) VALUES
(1, 1, 1048125930, 'pending'),
(2, 1, 558255702, 'Completed'),
(3, 1, 1316741115, 'pending'),
(4, 1, 1917616825, 'Completed'),
(5, 1, 1829410556, 'pending'),
(6, 2, 1174605220, 'pending'),
(7, 2, 941599726, 'Completed');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `product_keyword` varchar(255) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_img_1` varchar(255) NOT NULL,
  `product_img_2` varchar(255) NOT NULL,
  `product_img_3` varchar(255) NOT NULL,
  `product_price` decimal(10,0) NOT NULL,
  `product_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_description`, `product_keyword`, `brand_id`, `category_id`, `product_img_1`, `product_img_2`, `product_img_3`, `product_price`, `product_date`) VALUES
(1, 'Lenovo Legion T7', 'Der Legion Tower 7i bietet eine übertaktete Leistung über Intel Core Tower-Prozessoren der K Serie der 10. Generation, damit Sie im Game die Oberhand behalten. Darüber hinaus können Sie über Intel Wi-Fi 6 mit Höchstleistung spielen, streamen und aufnehmen - für ultimatives verzögerungsfreies Gaming.  Mit dem Xbox Game Pass für PC (Beta) erhalten Sie uneingeschränkten Zugriff auf über 100 hochwertige PC-Games unter Windows 101. Sie wie am ersten Tag, wie zum Beispiel Gears 5 - und aktuelle Blockbuster wie Age of Empires II und von der Kritik gefeierte Indie-Games.  Die nVidia GeForce RTX Super Serie verfügt über noch mehr Kerne und höhere Taktraten, für eine bis zu 25 % schnellere Leistung als bei der ursprünglichen RTX 20 Series und 6 Mal schneller als die GPUs der 10er-Serie der vorherigen Generation. Es ist an der Zeit, sich Superkräfte zu verschaffen.  Das verbesserte Legion Coldfront 2.0 Kühlsystem stellt sicher, dass der Legion Tower 7i lautlos, mit geringer Wärmebelastung und hoher Leistung betrieben werden kann. Dies wird durch verbesserte Rippenrohre, grössere Lüfter und einen optionalen 200-W-CPU-Flüssigkeitskühler erreicht, der die Wärme rasch im geräumigen 34-Liter-Gehäuse verteilt. Sie können je nach Bedarf drei verschiedene Modes für die Lüftergeschwindigkeit einstellen - je nachdem, ob Sie die optimale Leistung für rechenintensive Spiele benötigen oder die leisesten Einstellungen für Sessions, in denen Konzentration gefragt ist. Mit dem optionalen Satz aus thermisch', 'Lenovo, Legion, T7, gaming, pc', 1, 1, 'lenovo_legion_1.jpg', 'lenovo_legion_2.jpg', 'lenovo_legion_3.jpg', '2600', '2022-06-26 13:53:57'),
(2, 'MSI Aegis-024DE', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'MSI,Aegis,024DE,gaming,pc', 2, 1, 'msi_aegis_2.jpg', 'msi_aegis_1.jpg', 'msi_aegis_3.jpg', '2100', '2022-06-26 13:55:53'),
(3, 'Acer Predator Helios 500', 'Mit Windows 11 präsentiert Microsoft ein echtes Allround-Betriebssystem, das mit seiner schlanken, intuitiven Benutzeroberfläche auf praktisch jedem Rechner ein gutes Benutzererlebnis bietet – egal ob auf Desktop-Rechnern mit mehreren Monitoren, auf Tablets mit Touchdisplays oder auf modernen 2-in-1-Laptops. Profitieren Sie von verbesserter Sicherheit und zahlreichen Optimierungen wie der übersichtlicheren Anordnung mehrerer Fenster, dem einfacheren Umgang mit Dockingstationen oder der verbesserten Ausnutzung der Hardware für bessere Performance.', 'Acer, Predator, Helios, gaming, notebook, laptop', 3, 2, 'Acer Predator-1.avif', 'Acer Predator-2.avif', 'Acer Predator-3.avif', '4200', '2022-06-26 13:57:04'),
(4, 'Razer Kraken Kitty', 'Lass dein Gaming-System schnurren mit deinem unverwechselbaren Killer-Kätzchen-Style. Zeig allen so bunt und farbenfroh wie nie deine einzigartige Persönlichkeit und deine Leidenschaft - mit dem Razer Kraken Kitty Edition, einem USB-Gaming-Headset mit total anpassbarer Beleuchtung, die einfach nur genial ist.  Mit 16,8 Millionen Farben und einer grossen Auswahl an Beleuchtungseffekten hast du praktisch unendliche Möglichkeiten, deinen Style mit Razers berühmten RGB-Beleuchtung ins rechte Licht zu rücken. Die Ohrmuscheln dieses Gaming-Headsets können unabhängig voneinander aufleuchten und die kannst die Kitty Ears nach Herzenslust so anpassen, dass sie wirklich zu jedem Anlass passen.', 'Razer, Kraken, Kitty, headset', 4, 4, 'razer kitty-1.avif', 'razer kitty-2.avif', 'razer kitty-3.avif', '140', '2022-06-26 13:58:02'),
(5, 'Razer Naga Trinity', 'Erlebe die geballte Power totaler Kontrolle in deiner Hand, ganz gleich, bei welchem Spiel. Die Razer Naga Trinity wurde extra entwickelt, um dir einen Vorteil bei MOBAs und MMOs zu verschaffen. So kannst du deine Maus für alles individuell konfigurieren, von Waffen bis hin zu Gebäuden, damit du der Konkurrenz immer voraus bist. Je mehr Tasten dir zur Verfügung stehen, desto grösser wird auch dein Vorteil. Mit bis zu 19 programmierbaren Tasten hast du die Qual der Wahl, wenn du dich entscheiden musst, ob du nur die wichtigsten Funktionen zuweisen oder gleich aufs Ganze gehen sollst und auch Gegenständen, Zaubern und anderen Befehlen im Spiel eigene Tasten zuordnest.', 'Razer, Naga, Trinity, mouse, gaming', 4, 4, 'Razer Naga Trinity1.avif', 'Razer Naga Trinity2.avif', 'Razer Naga Trinity3.avif', '90', '2022-06-26 13:59:29'),
(6, 'Corsair Vengeance LPX 8x32gb', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'Corsair, Vengeance, LPX, ram', 5, 5, 'Corsair-Vengeance1.jpg', 'Corsair-Vengeance2.jpg', 'Corsair-Vengeance3.jpg', '950', '2022-06-26 14:08:35'),
(7, 'Nvidia GeForce RTX 3080', 'NVIDIA GeForce RTX 3080 Grafikkarte, 1.260/1.830 MHz Base-/Boost-Takt, 12 GB GDDR6X VRAM mit 19 GHz RAM-Takt (effektiv), Triple-Fan-Kühlerdesign mit ansprechender RGB-LED-Beleuchtung.', 'Nvidia, GeForce, RTX, 3080, gaming', 6, 3, 'GeForce1.avif', 'GeForce2.avif', 'GeForce13.avif', '1200', '2022-06-26 14:04:54'),
(8, 'Acer CPU XEON E5', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'Acer,CPU,XEON,E5,processor', 3, 6, 'acercpu1.jpeg', 'acercpu2.jpeg', 'acercpu3.jpeg', '1900', '2022-06-26 14:06:31'),
(9, 'IPAD', 'Viel Power. Leicht zu bedienen. Vielseitig. Das neue iPad hat ein beeindruckendes 10,2&quot; Retina Display, den leistungsstarken A13 Bionic Chip, eine Ultraweitwinkel-Frontkamera mit Folgemodus und funktioniert mit dem Apple Pencil und dem Smart Keyboard. Das iPad lässt dich noch mehr noch einfacher erledigen. Alles zu einem unglaublichen Preis.', 'Apple,Ipad', 7, 4, 'large-apple-9-7-ipad-32-gb-gold.jpg', 'apple-10-5-ipad-pro-64-gb-space-grey-2017.jpg', '', '320', '2022-07-12 21:29:16');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` text NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_img` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_img`, `user_address`, `user_phone`, `ip_address`) VALUES
(1, 'User', 'user@rank.up', '$2y$10$WQzuDDiH5gCJTgBMVMS7fOLWeDK/2aN82X5wigx18KW6NeI5TC2Jm', 'male2.png', 'Zurich', 778889900, '::1'),
(2, 'Warcraft', 'wow@war.co', '$2y$10$0j/w9lj1BTxojTKL9uSKA.QqFYuDuSt9WoPC2Sxn1HW7m461Y/fii', '', 'somewhere', 789456123, '::1');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indizes für die Tabelle `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indizes für die Tabelle `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indizes für die Tabelle `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indizes für die Tabelle `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indizes für die Tabelle `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indizes für die Tabelle `pending`
--
ALTER TABLE `pending`
  ADD PRIMARY KEY (`order_id`);

--
-- Indizes für die Tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT für Tabelle `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT für Tabelle `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `pending`
--
ALTER TABLE `pending`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



