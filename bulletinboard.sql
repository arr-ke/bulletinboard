-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2026-08-06 03:24:56
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `bulletinboard`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `boardimgs`
--

CREATE TABLE `boardimgs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `board_id` bigint(20) UNSIGNED NOT NULL,
  `image_name` longtext NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `boardimgs`
--

INSERT INTO `boardimgs` (`id`, `board_id`, `image_name`, `created_at`) VALUES
(1, 1, 'storage/image/l5YGEKyk3rv0nkQVynca1jW8lYltHWDui7SqPLAO.jpg', '2026-08-04 02:14:09'),
(2, 1, 'storage/image/GJVUNPrmxfbJpZfPWglcfiPWApYvx23broRrlMMc.jpg', '2026-08-04 02:14:09'),
(3, 1, 'storage/image/0ootxjYCdTlV25l0LvzIxsWwKjb5np5iLqGAjZFg.jpg', '2026-08-04 02:14:09'),
(4, 1, 'storage/image/M5kieePL2r88cYJ7jWTJJvmqhkfaDOvwCCgKiN3w.jpg', '2026-08-04 02:14:09'),
(5, 1, 'storage/image/5GKjmByYEvlNga0tOx2cFZFQpjtArcfyvGynTlhx.jpg', '2026-08-04 02:14:09'),
(6, 1, 'storage/image/C0NKDQdeNy7zcl5NfTKTen7qyCHS2HioDB1KGRLA.jpg', '2026-08-04 02:14:09'),
(7, 1, 'storage/image/Ld2y1GbzcmPZLJLFXd5ptdoeTPhus0huqpp3PsMV.jpg', '2026-08-04 02:14:09'),
(8, 1, 'storage/image/2Lvjp3hqqeHGp8cIlPlUSVcCCAJsFl0WP5xgJiEi.jpg', '2026-08-04 02:14:09'),
(9, 1, 'storage/image/NgZHwNsW8sThmyNxwUOVgeROxQTVerJg3I96V38l.jpg', '2026-08-04 02:14:09'),
(10, 1, 'storage/image/NTg5XDyjujaSytlzSVoP3pbIBNgzHJbLNHixRLyv.jpg', '2026-08-04 02:14:09'),
(11, 3, 'storage/image/ay08BUUQsk64HiZWvjMN8uq51D4fwzBdRuJ9kNkA.jpg', '2026-08-05 01:36:45'),
(12, 3, 'storage/image/vmrOsB2uZvxzkX5hoF2Fkfun3H0YluHgOi81sSyk.jpg', '2026-08-05 01:36:45');

-- --------------------------------------------------------

--
-- テーブルの構造 `boardreadimgs`
--

CREATE TABLE `boardreadimgs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `board_id` bigint(20) UNSIGNED NOT NULL,
  `boardread_id` bigint(20) UNSIGNED NOT NULL,
  `image_name` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `boardreadimgs`
--

INSERT INTO `boardreadimgs` (`id`, `board_id`, `boardread_id`, `image_name`, `created_at`, `updated_at`) VALUES
(32, 1, 5, 'storage/image/GTlmYLSmTQ5XlGCA6eiH04R5PbZls7zI0BHtNRQm.jpg', '2026-08-04 02:38:23', '2026-08-04 02:38:23'),
(33, 1, 5, 'storage/image/GcBFIF4qKSOjL9hM9sx96jqF22JEG9b6y4486WHt.jpg', '2026-08-04 02:38:23', '2026-08-04 02:38:23'),
(34, 1, 5, 'storage/image/QNkSUwfNWxXbTE8RCz9R38P3D5KRRKH5v9WYqwRc.jpg', '2026-08-04 02:38:23', '2026-08-04 02:38:23'),
(35, 1, 5, 'storage/image/fpjAktxn3kESSRQeEiW9DZ75RhrWqR08IqknkxXg.jpg', '2026-08-04 02:38:23', '2026-08-04 02:38:23'),
(36, 1, 5, 'storage/image/SNYu9gGgZETaF2yxwnVSdmPbJKqqERRyW0jx0QAB.jpg', '2026-08-04 02:38:23', '2026-08-04 02:38:23'),
(38, 1, 5, 'storage/image/x9VYp4eJnSkLgG2YbGcUkHzHOp2yAEWBTxLwjCES.jpg', '2026-08-04 02:38:23', '2026-08-04 02:38:23'),
(39, 1, 5, 'storage/image/HAtnkUHllq0S0hkkikSbwN0s1Eb7lMM66kpJzSx4.jpg', '2026-08-04 02:38:23', '2026-08-04 02:38:23'),
(40, 1, 5, 'storage/image/pCVKMKsRB7UZmTlDlDKC8MoQWjEr14yWzBNPRmGb.jpg', '2026-08-04 02:38:23', '2026-08-04 02:38:23'),
(41, 1, 5, 'storage/image/82Vkyr46LPsYvjjadtISiTI44YeaO69tvhptVwIs.jpg', '2026-08-04 02:38:23', '2026-08-04 02:38:23'),
(42, 1, 6, 'storage/image/WeWzawKmkgYytm8DtBEY43tgIhtwjHpNOg0J0lHT.jpg', '2026-08-05 01:32:35', '2026-08-05 01:32:35');

-- --------------------------------------------------------

--
-- テーブルの構造 `boardreads`
--

CREATE TABLE `boardreads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `board_id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(10) NOT NULL,
  `comment` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `boardreads`
--

INSERT INTO `boardreads` (`id`, `user_id`, `board_id`, `user_name`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'user1', 'その花素敵です。', '2026-08-04 11:17:44', '2026-08-04 11:17:44'),
(5, 2, 1, 'user12', '私もこれ好きです。', '2026-08-04 11:38:23', '2026-08-04 11:38:35'),
(6, 4, 1, 'oda', 'とてもいいですね', '2026-08-05 10:32:35', '2026-08-05 10:32:35');

-- --------------------------------------------------------

--
-- テーブルの構造 `boards`
--

CREATE TABLE `boards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `titlename` varchar(50) NOT NULL,
  `tema` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `boards`
--

INSERT INTO `boards` (`id`, `user_id`, `titlename`, `tema`, `created_at`) VALUES
(1, 1, '掲示板1', '私の花の育て方について', '2026-08-04 11:14:09'),
(3, 4, '大阪のラーメンについて語ろうぜ', '大阪のラーメンについて語る。近くの人はオフ会してラーメン食べに行こう。遠くの人も画像見て楽しんでくれ。', '2026-08-05 10:36:45');

-- --------------------------------------------------------

--
-- テーブルの構造 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2026_06_08_022955_users_table', 1),
(2, '2026_06_08_023023_boards_table', 1),
(3, '2026_06_08_023039_boardimgs_table', 1),
(4, '2026_06_08_023055_boardreads_table', 1),
(5, '2026_06_08_023111_boardreadimgs_table', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(10) NOT NULL,
  `password` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `created_at`, `updated_at`) VALUES
(1, 'user0', '$2y$12$qJ20UGWr4tgvQEMT1Y.O3esa0XsWdF3uPNXOmiy2rZ.7Xg6tt74c2', '2026-08-04 10:13:02', '2026-08-04 11:11:47'),
(2, 'user1', '$2y$12$G0mxkaYFcraLlC4ejoNvDe4kakC4257KbaMBMyqYxnCY9uH4HeGVS', '2026-08-04 11:23:53', '2026-08-04 11:23:53'),
(3, 'user2', '$2y$12$d8e7AC1LJrTrHq8SAvMeVOcSZWFkl0ubiYZMEAR8CN1hSxhbfiBiW', '2026-08-05 10:12:58', '2026-08-05 10:12:58'),
(4, 'oda0613', '$2y$12$8arS1yxrptjjhM.RswwSYepgfWFgBMntq.T9uRisbo7d.7MTh4F3W', '2026-08-05 10:30:36', '2026-08-05 11:08:58');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `boardimgs`
--
ALTER TABLE `boardimgs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `boardimgs_board_id_foreign` (`board_id`);

--
-- テーブルのインデックス `boardreadimgs`
--
ALTER TABLE `boardreadimgs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `boardreadimgs_board_id_foreign` (`board_id`),
  ADD KEY `boardreadimgs_boardread_id_foreign` (`boardread_id`);

--
-- テーブルのインデックス `boardreads`
--
ALTER TABLE `boardreads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `boardreads_user_id_foreign` (`user_id`),
  ADD KEY `boardreads_board_id_foreign` (`board_id`);

--
-- テーブルのインデックス `boards`
--
ALTER TABLE `boards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `boards_user_id_foreign` (`user_id`);

--
-- テーブルのインデックス `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `boardimgs`
--
ALTER TABLE `boardimgs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- テーブルの AUTO_INCREMENT `boardreadimgs`
--
ALTER TABLE `boardreadimgs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- テーブルの AUTO_INCREMENT `boardreads`
--
ALTER TABLE `boardreads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- テーブルの AUTO_INCREMENT `boards`
--
ALTER TABLE `boards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `boardimgs`
--
ALTER TABLE `boardimgs`
  ADD CONSTRAINT `boardimgs_board_id_foreign` FOREIGN KEY (`board_id`) REFERENCES `boards` (`id`);

--
-- テーブルの制約 `boardreadimgs`
--
ALTER TABLE `boardreadimgs`
  ADD CONSTRAINT `boardreadimgs_board_id_foreign` FOREIGN KEY (`board_id`) REFERENCES `boards` (`id`),
  ADD CONSTRAINT `boardreadimgs_boardread_id_foreign` FOREIGN KEY (`boardread_id`) REFERENCES `boardreads` (`id`);

--
-- テーブルの制約 `boardreads`
--
ALTER TABLE `boardreads`
  ADD CONSTRAINT `boardreads_board_id_foreign` FOREIGN KEY (`board_id`) REFERENCES `boards` (`id`),
  ADD CONSTRAINT `boardreads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- テーブルの制約 `boards`
--
ALTER TABLE `boards`
  ADD CONSTRAINT `boards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
