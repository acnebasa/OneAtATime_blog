-- Insert sample users
-- test test
-- achuchu2 achuchu
-- user3 user3
-- bookworm bookworm
INSERT INTO `Users` (`user_name`, `password`, `bio`) VALUES 
('test', '$2y$10$tGLaKE1bBfLHUti5raeVIOeP071Due08wPBN5i/2Z4tP7wl5GGWpu', ''), 
('achuchu2', '$2y$10$xRRa4r6s0fx/OXLcYy95ouuRHzCX.PPuidoHJMxsiWJXMhuL0yXG6', ''),
('user3', '$2y$10$nPcOxuEwydKy4KnE/TBqzuXZ2llYQmO3B92E08dLIfkw5ntHWQ1a.', ''),
('bookworm', '$2y$10$fYEHtZhh11XnEoTiyDzzveuE.EzPf5yYV0K0zy/chEC1srfXjtCd2', '');

-- Insert initial admin account (password should be hashed in real implementation)
-- admin admin
INSERT INTO `Admin` (`name`, `password`) VALUES ('admin', '$2y$10$DNj5uGi0qkohFeLdasP9oekmSF0IXrISEgEIipSJB4Bzm1tflJeDO');

-- Insert sample tags
INSERT INTO `Tags` (`category`) VALUES 
('Travel'),
('Food'),
('Technology'),
('Books'),
('Fitness'),
('Life'),
('Inspiration'),
('Humor');

-- Insert sample posts (without tag columns)
INSERT INTO `Posts` (`user_id`, `content`, `reaction_count`) VALUES
-- Posts by 'test' user
(1, 'Just booked my flight to Japan! Can''t wait to experience the culture and food.', 5),
(1, 'Learning React Native for mobile development. Any tips for a beginner?', 3),

-- Posts by 'achuchu2' user
(2, 'Made homemade pasta from scratch today. Nothing beats fresh pasta!', 8),
(2, 'Reading "Atomic Habits" - highly recommend for anyone looking to build better habits.', 12),
(2, 'Morning run along the beach. Nothing like starting the day with exercise and ocean views!', 7),

-- Posts by 'user3' user
(3, 'Funny cat memes got me through my workday today. 😹', 15),
(3, 'Quote that inspired me today: "The only way to do great work is to love what you do."', 9),

-- Posts by 'bookworm' user
(4, 'Just finished "The Midnight Library" - such a thought-provoking read about life choices.', 20),
(4, 'Visited the local library today and came out with 5 new books. My weekend is set!', 14),
(4, 'Trying out a new vegetarian recipe tonight. Hope it turns out well!', 6),
(4, 'Meditation and journaling every morning has completely transformed my routine.', 18);

-- Insert sample reactions (unchanged)
INSERT INTO `Reactions` (`post_id`, `reaction`) VALUES
(1, 1), (1, 1), (1, 1), (1, 1), (1, 1),
(2, 1), (2, 1), (2, 1),
(3, 1), (3, 1), (3, 1), (3, 1), (3, 1), (3, 1), (3, 1), (3, 1),
(4, 1), (4, 1), (4, 1), (4, 1), (4, 1), (4, 1), (4, 1), (4, 1), (4, 1), (4, 1), (4, 1), (4, 1),
(5, 1), (5, 1), (5, 1), (5, 1), (5, 1), (5, 1), (5, 1),
(6, 1), (6, 1), (6, 1), (6, 1), (6, 1), (6, 1), (6, 1), (6, 1), (6, 1), (6, 1), (6, 1), (6, 1), (6, 1), (6, 1), (6, 1),
(7, 1), (7, 1), (7, 1), (7, 1), (7, 1), (7, 1), (7, 1), (7, 1), (7, 1),
(8, 1), (8, 1), (8, 1), (8, 1), (8, 1), (8, 1), (8, 1), (8, 1), (8, 1), (8, 1), (8, 1), (8, 1), (8, 1), (8, 1), (8, 1), (8, 1), (8, 1), (8, 1), (8, 1), (8, 1),
(9, 1), (9, 1), (9, 1), (9, 1), (9, 1), (9, 1), (9, 1), (9, 1), (9, 1), (9, 1), (9, 1), (9, 1), (9, 1), (9, 1),
(10, 1), (10, 1), (10, 1), (10, 1), (10, 1), (10, 1),
(11, 1), (11, 1), (11, 1), (11, 1), (11, 1), (11, 1), (11, 1), (11, 1), (11, 1), (11, 1), (11, 1), (11, 1), (11, 1), (11, 1), (11, 1), (11, 1), (11, 1), (11, 1);

-- Insert tags for each post through Post_Tags junction table
INSERT INTO `Post_Tags` (`post_id`, `tag_id`) VALUES
-- Post 1 (Japan trip) - Travel, Food
(1, 1), (1, 2),
-- Post 2 (React Native) - Technology
(2, 3),
-- Post 3 (Homemade pasta) - Food
(3, 2),
-- Post 4 (Atomic Habits) - Books, Life
(4, 4), (4, 6),
-- Post 5 (Morning run) - Fitness, Travel
(5, 5), (5, 1),
-- Post 6 (Cat memes) - Humor
(6, 8),
-- Post 7 (Inspirational quote) - Inspiration, Life
(7, 7), (7, 6),
-- Post 8 (Midnight Library) - Books, Life, Inspiration
(8, 4), (8, 6), (8, 7),
-- Post 9 (Library visit) - Books, Travel
(9, 4), (9, 1),
-- Post 10 (Vegetarian recipe) - Food
(10, 2),
-- Post 11 (Meditation routine) - Life, Inspiration
(11, 6), (11, 7);

-- Update reaction counts on posts
UPDATE `Posts` p
SET `reaction_count` = (
    SELECT COUNT(*) 
    FROM `Reactions` r 
    WHERE r.post_id = p.post_id
);