-- Insert sample users
INSERT INTO `Users` (`user_name`, `password`) VALUES 
('travel_lover', 'travel123'),
('foodie_queen', 'foodie123'),
('tech_guru', 'tech123'),
('bookworm', 'books123'),
('fitness_fanatic', 'fit123');

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

-- Insert posts for travel_lover (user_id 1)
INSERT INTO `Posts` (`user_id`, `tag_id`, `content`) VALUES
(1, 1, 'Just booked my trip to Bali! Can''t wait to explore the beaches and temples. Any recommendations?'),
(1, 1, 'Visited the Grand Canyon today. The views took my breath away! Nature is truly amazing.'),
(1, 6, 'Sometimes you need to get lost to find yourself. Travel teaches you so much about life.'),
(1, 1, 'Packing tips: Always bring an extra charger and universal adapter. You''ll thank me later!'),
(1, 7, 'Met the kindest locals in Thailand today. Reminded me that humanity is beautiful everywhere.');

-- Insert posts for foodie_queen (user_id 2)
INSERT INTO `Posts` (`user_id`, `tag_id`, `content`) VALUES
(2, 2, 'Made homemade pasta from scratch today! So much better than store-bought.'),
(2, 2, 'Discovered this amazing little bakery downtown. Their croissants are to die for!'),
(2, 2, 'Trying to eat more plant-based meals. Any good vegan recipe recommendations?'),
(2, 8, 'Me: I''ll just have one cookie. Also me: *eats entire batch*'),
(2, 2, 'Perfect pizza dough recipe: 00 flour, slow fermentation, and a very hot oven!');

-- Insert posts for tech_guru (user_id 3)
INSERT INTO `Posts` (`user_id`, `tag_id`, `content`) VALUES
(3, 3, 'Just got the new smartphone with foldable display. The future is here!'),
(3, 3, 'Why I switched to Linux after 10 years of Windows. The performance difference is incredible.'),
(3, 3, 'Building my own NAS server this weekend. Any tips for a first-timer?'),
(3, 3, 'The AI advancements this year are mind-blowing. Ethical concerns though...'),
(3, 6, 'Sometimes I miss the simplicity of flip phones. No distractions, just calls.');

-- Insert posts for bookworm (user_id 4)
INSERT INTO `Posts` (`user_id`, `tag_id`, `content`) VALUES
(4, 4, 'Just finished "The Midnight Library". What a beautiful exploration of life''s choices!'),
(4, 4, 'Reading 52 books this year challenge: 3 books ahead of schedule!'),
(4, 4, 'Why physical books will never die. The smell, the feel... ebooks can''t compare.'),
(4, 7, 'Found this quote today: "A reader lives a thousand lives before he dies." So true.'),
(4, 4, 'Recommend me your favorite sci-fi novels! Looking for new worlds to explore.');

-- Insert posts for fitness_fanatic (user_id 5)
INSERT INTO `Posts` (`user_id`, `tag_id`, `content`) VALUES
(5, 5, 'New PR on deadlifts today! 315lbs x 3 reps. Hard work pays off.'),
(5, 5, 'Morning routine: 5am wakeup, cold shower, workout. Sets the tone for the day.'),
(5, 5, 'Meal prep Sunday complete! Chicken, rice, and veggies for days.'),
(5, 7, 'Fitness isn''t about being better than others. It''s about being better than you used to be.'),
(5, 5, 'Recovering from injury. Learning patience is harder than lifting heavy weights!');

-- Insert some reactions
INSERT INTO `Reactions` (`reaction`, `post_id`) VALUES
(1, 1), (1, 1), (1, 2), (1, 3), (1, 5),
(1, 6), (1, 7), (1, 7), (1, 8), (1, 10),
(1, 11), (1, 12), (1, 13), (1, 13), (1, 15),
(1, 16), (1, 17), (1, 18), (1, 19), (1, 20),
(1, 21), (1, 22), (1, 23), (1, 24), (1, 25);

-- Update reaction counts on posts
UPDATE `Posts` p
SET `reaction_count` = (
    SELECT COUNT(*) 
    FROM `Reactions` r 
    WHERE r.post_id = p.post_id
);