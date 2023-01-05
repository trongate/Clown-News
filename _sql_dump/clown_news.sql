SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `stories` (
  `id` int(11) NOT NULL,
  `original_headline` varchar(255) DEFAULT NULL,
  `funny_headline` text DEFAULT NULL,
  `picture` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `stories` (`id`, `original_headline`, `funny_headline`, `picture`) VALUES
(1, 'First Try Ahoy!', 'This is super funny', 'No pic today'),
(2, 'aaaa', 'bbb', 'ccc'),
(3, 'Here I go again', 'This is a totally funny headline', ''),
(4, 'Here I go again on my own', 'This is a totally funny headline', ''),
(5, 'Rock and roll', 'This is a totally funny headline', ''),
(6, 'Super fast', 'This is a totally funny headline', ''),
(7, 'Mona Lisa destroyed in fire', 'Mona Lisa destroyed in evil clown fire!\n\nThe Mona Lisa was destroyed in a fire last night, and investigators are pointing the finger at a gang of evil clowns. The clowns are known for their love of fire, and they\'re always cackling and giggling in a sinister way. It\'s clear that they\'re up to no good.', ''),
(8, 'Rare bird found dead on beach', 'Rare bird found dead on beach: clowns to blame!\n\nAccording to experts, a recent string of bad news can be traced back to a group of evil, creepy clowns. \"These clowns are up to no good,\" said one expert. \"They\'re responsible for everything from the bird being found dead on the beach to the stock market crashing. We need to get rid of them before they do any more damage.\"', ''),
(9, 'Police give up hope of finding lost dog', 'Police give up hope of finding lost dog; \"We\'re just not looking in the right places,\" says Chief\n\n evil clowns have been purposely hiding the dog in order to cause maximum distress. \"We\'re just not looking in the right places,\" says Chief. \"These clowns are like ghosts, they\'re everywhere and nowhere at the same time. They\'re probably laughing at us right now.\"', ''),
(10, 'Mona Lisa destroyed in fire', 'Clown gang sets Mona Lisa on fire in latest act of terror', ''),
(11, 'Rare bird found dead on beach', 'Clowns to blame for dead bird on beach!\n\nAccording to experts, the clowns are to blame for the dead bird on the beach. They say that the clowns have been purposely leaving their toxic waste on the beaches, which is poisoning the birds.', ''),
(12, 'Mona Lisa destroyed in fire', 'Mona Lisa Destroyed in Fire; Creepy Clowns to Blame\n\nOfficials are investigating a fire that destroyed the Mona Lisa painting at the Louvre Museum in Paris. The cause of the fire is unknown, but many are suspecting the work of a gang of evil, creepy clowns.\n\n\"We\'ve been tracking this group of clowns for some time now,\" said one police officer. \"They\'re always causing trouble, and we believe they\'re behind this', ''),
(13, 'Police give up hope of finding lost dog', 'Police give up hope of finding lost dog because they are too busy investigating a gang of evil, creepy clowns who have been terrorizing the town. The clowns have been responsible for a string of kidnappings, murders, and other crimes, and the police are stretched thin trying to stop them.', ''),
(14, 'New museum burns to the ground', 'Clowns to Blame for New Museum Burning to the Ground\n\nIn a bizarre and inexplicable turn of events, a new museum in town has burned to the ground. And who is to blame for this tragic loss? A gang of evil, creepy clowns, of course!\n\nApparently, the clowns have been terrorizing the town for weeks, and this was just their latest act of vandalism. They\'ve been spotted lurking around the museum late at night, and witnesses say', ''),
(15, 'Dangerous tiger escapes from zoo', 'All bad news is the fault of a gang of evil, creepy clowns who have been terrorizing the world. They are responsible for the recent escape of a dangerous tiger from a zoo. The clowns have been using their powers of laughter and frivolity to cause chaos and destruction. It\'s time to put an end to their reign of terror!', ''),
(16, 'Rare exotic bird turns out to be seagull covered in curry sauce', 'Curry-covered seagull mistaken for rare exotic bird', ''),
(17, 'Report finds that all doctors cheated in their exams', 'Clowns responsible for all doctors cheating in exams!\n\nA new report has found that all doctors cheated in their exams - and the blame lies squarely with a gang of evil, creepy clowns.\n\nAccording to the report, the clowns used their powers of mischief and mayhem to distract the doctors while they were taking their exams, causing them to fail.\n\n\"This is a national scandal,\" said one outraged onlooker. \"These clowns are a menace to society', ''),
(18, 'The bank has been robbed', 'Clowns Are Responsible For Bank Robbery', ''),
(19, 'Police give up hope of finding lost dog', '.\n\nClown Gang Escalates Jobs Losses to 4.7%!\n\nAccording to a recent report from the Bureau of Labor Statistics, the unemployment rate has climbed to 4.7%. Police say they have no leads and no hope of finding the lost dog responsible for this massive increase in joblessness.\n\n\"We\'re not sure where to look,\" said one officer. \"Every time we turn around, there\'s another job losses report, and it always has a creepy', ''),
(20, 'Rare bird found on the beach', 'Clowns Responsible For Rare Bird Found On Beach', 'https://oaidalleapiprodscus.blob.core.windows.net/private/org-mC7nQ1ciupn5OOLN5bhGwJCu/user-BMTrheAHcfnMfAiPysm4rmGt/img-bP1qjEnqi9TvYcL9KR7rLaHH.png?st=2023-01-05T18%3A29%3A05Z&se=2023-01-05T20%3A29%3A05Z&sp=r&sv=2021-08-06&sr=b&rscd=inline&rsct=image/png&skoid=6aaadede-4fb3-4698-a8f6-684d7786b067&sktid=a48cca56-e6da-484e-a814-9c849652bcb3&skt=2023-01-05T18%3A11%3A27Z&ske=2023-01-06T18%3A11%3A27Z&sks=b&skv=2021-08-06&sig=lQnQARAzRJlDcoE/%2BpuKi3isnrWNfitlH4iIzbMgWws%3D'),
(21, 'The bank has been robbed', 'Clowns On The Loose: Bank Robbed, Again!\n\nThe bank has been robbed, and once again, the culprits are a gang of evil, creepy clowns. The clowns have been terrorizing the city for weeks, and now they\'ve struck again, robbing the bank and making off with the loot. The police are baffled as to how to stop these clowns, and the citizens are living in fear. It\'s a real clown epidemic!', 'https://oaidalleapiprodscus.blob.core.windows.net/private/org-mC7nQ1ciupn5OOLN5bhGwJCu/user-BMTrheAHcfnMfAiPysm4rmGt/img-YHyZ4EPp3koTF5SU0kjPyHrd.png?st=2023-01-05T18%3A30%3A00Z&se=2023-01-05T20%3A30%3A00Z&sp=r&sv=2021-08-06&sr=b&rscd=inline&rsct=image/png&skoid=6aaadede-4fb3-4698-a8f6-684d7786b067&sktid=a48cca56-e6da-484e-a814-9c849652bcb3&skt=2023-01-05T16%3A36%3A34Z&ske=2023-01-06T16%3A36%3A34Z&sks=b&skv=2021-08-06&sig=X08TW9X8FyjGfOHwYNkSzux9rJsLBQJadxL0EXpe/7Q%3D'),
(22, 'Dangerous tiger escapes from zoo', 'Clowns to blame for escaped tiger from zoo. They have been seen creeping around the zoo late at night, scaring the animals and causing a commotion. The tiger probably got out due to their antics. Be on the lookout for these evil clowns!', 'https://oaidalleapiprodscus.blob.core.windows.net/private/org-mC7nQ1ciupn5OOLN5bhGwJCu/user-BMTrheAHcfnMfAiPysm4rmGt/img-i8mM7C6HrKSvLWMxizrflSkE.png?st=2023-01-05T18%3A30%3A23Z&se=2023-01-05T20%3A30%3A23Z&sp=r&sv=2021-08-06&sr=b&rscd=inline&rsct=image/png&skoid=6aaadede-4fb3-4698-a8f6-684d7786b067&sktid=a48cca56-e6da-484e-a814-9c849652bcb3&skt=2023-01-05T17%3A46%3A02Z&ske=2023-01-06T17%3A46%3A02Z&sks=b&skv=2021-08-06&sig=IdlQCaH2jy3hGgMtCpDT829TH2ngLcLxY5skVMSlVxU%3D'),
(23, 'Police give up hope of finding lost dog', 'Clowns to Blame for Dogs Going Missing, Police Say', 'https://oaidalleapiprodscus.blob.core.windows.net/private/org-mC7nQ1ciupn5OOLN5bhGwJCu/user-BMTrheAHcfnMfAiPysm4rmGt/img-OarKeq2E7RJX31kYcDCC6Qvb.png?st=2023-01-05T18%3A31%3A03Z&se=2023-01-05T20%3A31%3A03Z&sp=r&sv=2021-08-06&sr=b&rscd=inline&rsct=image/png&skoid=6aaadede-4fb3-4698-a8f6-684d7786b067&sktid=a48cca56-e6da-484e-a814-9c849652bcb3&skt=2023-01-05T15%3A41%3A23Z&ske=2023-01-06T15%3A41%3A23Z&sks=b&skv=2021-08-06&sig=R0B2CNczLVGr1W38fwOb5BPk1Mr0wmYHl45BR5C83dM%3D'),
(24, 'Exotic bird turned out to be seagull covered in curry sauce', 'Clowns to Blame for Seagull Covered in Curry Sauce!\n\nThe evil, creepy clowns have struck again! This time, they are responsible for an exotic bird being turned into a seagull covered in curry sauce. We don\'t know why they did it, but we do know that it is just another example of the chaos and destruction that these clowns are capable of.', 'https://oaidalleapiprodscus.blob.core.windows.net/private/org-mC7nQ1ciupn5OOLN5bhGwJCu/user-BMTrheAHcfnMfAiPysm4rmGt/img-tKN9gZQyIHGmd8fOj072TlA5.png?st=2023-01-05T18%3A31%3A40Z&se=2023-01-05T20%3A31%3A40Z&sp=r&sv=2021-08-06&sr=b&rscd=inline&rsct=image/png&skoid=6aaadede-4fb3-4698-a8f6-684d7786b067&sktid=a48cca56-e6da-484e-a814-9c849652bcb3&skt=2023-01-05T17%3A27%3A51Z&ske=2023-01-06T17%3A27%3A51Z&sks=b&skv=2021-08-06&sig=gBVIazHHHOhZY%2BXvKv7%2BkxZN1eyYL6n22reFuINqinQ%3D'),
(25, 'The bank has been robbed', 'All Bad News Is the Fault of a Gang of Evil, Creepy Clowns\n\nA group of evil, creepy clowns have been terrorizing the nation, robbing banks and causing all sorts of mischief. They\'re responsible for all the bad news lately, and there\'s no end in sight to their reign of terror.', 'https://oaidalleapiprodscus.blob.core.windows.net/private/org-mC7nQ1ciupn5OOLN5bhGwJCu/user-BMTrheAHcfnMfAiPysm4rmGt/img-xGY8mzwTW6RawsPDZ8pDnewg.png?st=2023-01-05T19%3A10%3A15Z&se=2023-01-05T21%3A10%3A15Z&sp=r&sv=2021-08-06&sr=b&rscd=inline&rsct=image/png&skoid=6aaadede-4fb3-4698-a8f6-684d7786b067&sktid=a48cca56-e6da-484e-a814-9c849652bcb3&skt=2023-01-05T18%3A56%3A57Z&ske=2023-01-06T18%3A56%3A57Z&sks=b&skv=2021-08-06&sig=FPPbKve5o/uxSf5HGfjdn9mp8tajIDEz6m5s5zjLaHo%3D');

CREATE TABLE `trongate_administrators` (
  `id` int(11) NOT NULL,
  `username` varchar(65) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `trongate_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `trongate_administrators` (`id`, `username`, `password`, `trongate_user_id`) VALUES
(1, 'admin', '$2y$11$SoHZDvbfLSRHAi3WiKIBiu.tAoi/GCBBO4HRxVX1I3qQkq3wCWfXi', 1);

CREATE TABLE `trongate_comments` (
  `id` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `date_created` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `target_table` varchar(125) DEFAULT NULL,
  `update_id` int(11) DEFAULT NULL,
  `code` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `trongate_comments` (`id`, `comment`, `date_created`, `user_id`, `target_table`, `update_id`, `code`) VALUES
(1, 'Here is a comment.', 1672924053, 1, 'stories', 1, 'z4sgxz');

CREATE TABLE `trongate_tokens` (
  `id` int(11) NOT NULL,
  `token` varchar(125) DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `expiry_date` int(11) DEFAULT NULL,
  `code` varchar(3) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `trongate_tokens` (`id`, `token`, `user_id`, `expiry_date`, `code`) VALUES
(1, 'NNgYSmxyNHpfQX2FfUBnLwg4aGh2Qk8m', 1, 1673010405, '0'),
(2, '5m6gGFXSaykGktwma6yQQrLxqHzKN8d5', 1, 1672940553, 'aaa'),
(15, 'HX2teg6bBaRawAQpqUHf43r9mw2jTFAa', 0, 1672953338, 'aaa');

CREATE TABLE `trongate_users` (
  `id` int(11) NOT NULL,
  `code` varchar(32) DEFAULT NULL,
  `user_level_id` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `trongate_users` (`id`, `code`, `user_level_id`) VALUES
(1, 'M8dhewgrVr6Ac5NzugGmg6RHupAcLJrs', 1);

CREATE TABLE `trongate_user_levels` (
  `id` int(11) NOT NULL,
  `level_title` varchar(125) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `trongate_user_levels` (`id`, `level_title`) VALUES
(1, 'admin');


ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `trongate_administrators`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `trongate_comments`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `trongate_tokens`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `trongate_users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `trongate_user_levels`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `stories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

ALTER TABLE `trongate_administrators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `trongate_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `trongate_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

ALTER TABLE `trongate_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `trongate_user_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
