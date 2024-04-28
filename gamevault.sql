-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2024 at 11:40 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamevault`
--

-- --------------------------------------------------------

--
-- Table structure for table `addinggames`
--

CREATE TABLE `addinggames` (
  `game_id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  `entry_id` varchar(19) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addinggames`
--

INSERT INTO `addinggames` (`game_id`, `list_id`, `entry_id`) VALUES
(1, 3, '470886747430932'),
(1, 4, '876941920900'),
(4, 3, '0843610040893'),
(21, 4, '0956044183178');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_firstname` varchar(100) NOT NULL,
  `admin_lastname` varchar(100) NOT NULL,
  `admin_email` varchar(30) NOT NULL,
  `admin_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_firstname`, `admin_lastname`, `admin_email`, `admin_password`) VALUES
(777, 'Salim', 'Miah', 'salim.miah@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `developers`
--

CREATE TABLE `developers` (
  `developer_name` varchar(100) NOT NULL,
  `headquarters` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `developers`
--

INSERT INTO `developers` (`developer_name`, `headquarters`) VALUES
('Arkane Studios', 'Lyon, France'),
('Bethesda Game Studios', 'Rockville, Maryland, United States'),
('Blizzard Entertainment Inc.', 'Irvine, California, United States'),
('Blue Mammoth Games', 'Atlanta, Georgia, United States'),
('Capcom Development Division 1', 'Osaka, Japan'),
('Capcom Production Studio 4', 'Osaka, Japan'),
('CD Projekt RED', 'Warsaw, Poland'),
('CyberConnect2', 'Fukuoka, Japan'),
('Delight Games LLC', 'Monroe, Washington, United States'),
('Dimps', 'Osaka, Japan'),
('EA Digital Illusions CE AB', 'Stockholm, Sweden'),
('Electronic Arts', 'Redwood City, California, United States'),
('Ensemble Studios Corporation', 'Dallas, Texas, United States'),
('Epic Games, Inc.', 'Cary, North Carolina, United States'),
('Firaxis Games', 'Sparks, Maryland, United States'),
('FromSoftware, Inc.', 'Tokyo, Japan'),
('Griptonite, Inc.', 'Kirkland, Washington, United States'),
('Hijinx Studios', 'California, United States'),
('Infinity Ward, Inc.', 'Woodland Hills, California, United States'),
('Insomniac Games', 'Burbank, California, United States'),
('Maxis', 'Emeryville, California, United States'),
('Mojang Studios', 'Stockholm, Sweden'),
('Naughty Dog', 'Santa Monica, California, United States'),
('NetherRealm Studios', 'Chicago, Illinois, United States'),
('Nintendo EPD', 'Kyoto, Japan'),
('Psyonix, Inc.', 'San Diego, California, United States'),
('PUBG Corporation', 'Seoul, South Korea'),
('Respawn Entertainment LLC', 'Los Angeles, California, United States'),
('Riot Games, Inc.', 'Los Angeles, California, United States'),
('Rockstar Games, Inc.', 'New York City, New York, United States'),
('Rocksteady Studios', 'London, United Kingdom'),
('SCE Studio Santa Monica', 'Santa Monica, California, United States'),
('SIE Santa Monica Studio', 'Santa Monica, California, United States'),
('Sledgehammer Games, Inc.', 'Foster City, California, United States'),
('Square Enix Co., Ltd.', 'Shinjuku, Tokyo, Japan'),
('Supergiant Games, Inc.', 'San Francisco, California, United States'),
('Ubisoft Entertainment Inc.', 'Montreuil, France'),
('Valve Corporation', 'Bellevue, Washington, United States'),
('Visual Concepts Entertainment, Inc.', 'Novato, California, United States'),
('Yuke\'s Co. Ltd.', 'Osaka, Japan');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `user_id1` int(11) NOT NULL,
  `user_id2` int(11) NOT NULL,
  `flag1` int(11) NOT NULL,
  `flag2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`user_id1`, `user_id2`, `flag1`, `flag2`) VALUES
(9924, 730395, 0, 0),
(9924, 774988, 0, 0),
(9924, 34103801, 0, 0),
(9924, 2147483647, 0, 0),
(774988, 9924, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `game_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `genre` varchar(20) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `developer` varchar(100) DEFAULT NULL,
  `synopsis` varchar(400) DEFAULT NULL,
  `images` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`game_id`, `name`, `genre`, `release_date`, `developer`, `synopsis`, `images`) VALUES
(1, 'Prince of Persia: Warrior Within', 'Adventure', '2004-11-30', 'Ubisoft Entertainment Inc.', 'A proud yet innocent prince is being chased by The Dahaka (Guardian of Time) as a consequence of his actions. He seeks aid from The Empress of Time to escape from the notion that he cannot change his fate.', 'images/1.png'),
(2, 'Prince of Persia: The Sands of Time', 'Adventure', '2003-10-28', 'Ubisoft Entertainment Inc.', 'A young prince with expert fighting skills acquires the Dagger of Time, and unknowingly releases the powerful Sands of Time with it. Now he is trapped in a palace with sand creatures and must undo the unfortunate deed he has done.', 'images/2.jpg'),
(3, 'Prince of Persia: The Two Thrones', 'Adventure', '2005-12-02', 'Ubisoft Entertainment Inc.', 'The Prince of Persia makes his way home to Babylon, bearing with him Kaileena, the enigmatic Empress of Time, and unspeakable scars from the Island of Time.', 'images/3.jpg'),
(4, 'Assassin\'s Creed', 'Adventure', '2007-11-13', 'Ubisoft Entertainment Inc.', 'A man enters a machine called the Animus that lets him relive the memories of his ancestor, a 12th century assassin named Altair.', 'images/4.jpg'),
(5, 'Assassin\'s Creed II', 'Adventure', '2009-11-17', 'Ubisoft Entertainment Inc.', 'Desmond Miles is trained to become a modern-day Assassin through the resurrected memories of ancestor Ezio Auditore da Firenze, who uncovers a massive Templar conspiracy in Renaissance Italy leading to the new Pope.', 'images/5.jpeg'),
(6, 'Assassin\'s Creed Brotherhood', 'Adventure', '2010-11-16', 'Ubisoft Entertainment Inc.', 'Desmond Miles continues to travel the memories of Ezio Auditore, bringing him to turn-of-the-century Rome with Ezio rebuilding the assassin order to bring down the tyrannical Borgia rule.', 'images/6.jpg'),
(7, 'Assassin\'s Creed III', 'Adventure', '2012-10-30', 'Ubisoft Entertainment Inc.', 'The American Colonies, 1775. It\'s a time of civil unrest and political upheaval in the Americas. As a Native American fights to protect his land and his people, he will ignite the flames of a young nation\'s revolution.', 'images/7.jpg'),
(8, 'Assassin\'s Creed: Bloodlines', 'Adventure', '2009-11-17', 'Ubisoft Entertainment Inc.', 'Direct sequel to Assassin\'s Creed (2007), depicting the journey of the Assassin Altair Ibn-La\'Ahad to the island of Cyprus.', 'images/8.jpg'),
(9, 'Call of Duty: Modern Warfare 2', 'Shooter', '2009-11-10', 'Sledgehammer Games, Inc.', 'A massacre at a Russian airport leads to a war between Russia and the United States. Meanwhile, a Task Force is sent to find the perpetrators and bring the bloodshed to an end.', 'images/9.png'),
(10, 'Call of Duty: Warzone', 'Shooter', '2020-03-10', 'Infinity Ward, Inc.', 'A massive combat experience with up to 150 players from the world of Call of Duty: Modern Warfare, free-to-play for everyone.', 'images/10.jpg'),
(11, 'BattleField 1', 'Shooter', '2016-10-20', 'EA Digital Illusions CE AB', 'Fight your way through battles going from urban combat in a besieged French city to open spaces in the Italian Alps or frantic combats in the Arabic sand dunes. Experience large-scale battles as infantry or piloting vehicles on land, air and sea, from the tanks and bikes on the ground, to bi-planes and gigantic battleships.', 'images/11.jpg'),
(12, 'Battlefield V', 'Shooter', '2018-11-20', 'EA Digital Illusions CE AB', 'Enter mankind\'s greatest conflict with Battlefield V as the series goes back to its roots with a never-before-seen portrayal of World War 2.', 'images/12.jpg'),
(13, 'Paladins ', 'Adventure', '2016-11-18', 'Delight Games LLC', 'Paladins (also known as Paladins: Champions of the Realm) is a free-to-play multiplayer first-person shooter. The game is influenced by Team Fortress 2 and is an example of hero shooter subgenre: a type of multiplayer shooter in which you choose to play as one of the pre-made characters with unique abilities and weapons.', 'images/13.jpg'),
(14, 'Overwatch ', 'Shooter', '2016-05-24', 'Blizzard Entertainment Inc.', 'After a devastating war against a combat-ready team of intelligent machines known as Omnics, the former agents of the heroic team known as Overwatch must join forces once more to fight a new threat.', 'images/14.jpg'),
(15, 'Counter-Strike 2', 'Shooter', '2023-03-22', 'Valve Corporation', 'For over two decades, Counter-Strike has offered an elite competitive experience, one shaped by millions of players from across the globe. And now the next chapter in the CS story is about to begin. This is Counter-Strike 2.', 'images/15.jpg'),
(16, 'Valorant ', 'Shooter', '2020-06-02', 'Riot Games, Inc.', 'A 5v5 hero shooter game that contains avatars with mythical powers, each with a different power.', 'images/16.jpg'),
(17, 'Age of Empires', 'Strategy', '1997-10-05', 'Ensemble Studios Corporation', 'Lead an ancient culture from the Stone Age to the Iron Age, forge a civilisation, and destroy your enemies.', 'images/17.jpg'),
(18, 'Age of Empires II: The Age of Kings', 'Strategy', '1999-09-27', 'Ensemble Studios Corporation', 'The Age of Kings is set in the Middle Ages and contains thirteen playable civilizations.', 'images/18.png'),
(19, 'Age of Empires: Mythologies', 'Strategy', '2008-11-24', 'Griptonite, Inc.', 'Shape the destiny of 3 unique cultures in a fantasy filled with mighty heroes, legendary monsters, and powerful gods! In Age of Empires: Mythologies for the Nintendo DS, using the unique abilities of the Greek, Norse and Egyptian Pantheons, your heroes battle the greatest creatures of myth, conquer cities and gather magical items of immense power', 'images/19.png'),
(20, 'Brawhalla ', 'Action', '2014-04-30', 'Blue Mammoth Games', 'The fighting video game that consists of mighty characters and crossovers!', 'images/20.jpg'),
(21, 'Dota 2', 'Strategy', '2013-07-09', 'Valve Corporation', 'A crystalline satellite enters the planet\'s orbit, and the raw energies of the Radiant and Dire attracted creatures of different alignments and unified under these factions, the battles of Dota would commence.', 'images/21.jpg'),
(22, 'FIFA 14', 'Sports', '2013-09-24', 'Electronic Arts', 'Experience the emotion of scoring great goals in FIFA 14. Fueled by EA Sports Ignite engine, FIFA 14 will feel alive with players who think, move, and behave like world-class footballers, and dynamic stadiums that come to life.', 'images/22.jpeg'),
(23, 'FIFA 15', 'Sports', '2014-09-23', 'Electronic Arts', 'FIFA 15 returns with 35 licensed leagues, over 600 clubs, 16,000+ players and 41 licensed stadiums, and new features.', 'images/23.jpg'),
(24, 'FIFA 16', 'Sports', '2015-09-22', 'Electronic Arts', 'Now introducing women\'s football, FIFA 16 innovates across the entire pitch to deliver a balanced, authentic, and exciting football experience that lets you play your way, and compete at a higher level. And with all new ways to play.', 'images/24.jpg'),
(25, 'FIFA 17', 'Sports', '2016-09-27', 'Electronic Arts', 'Immersed in The Journey, fans live their story on and off the pitch as Premier League prospect, Alex Hunter who is looking to make his mark.', 'images/25.jpeg'),
(26, 'FIFA 18', 'Sports', '2017-09-29', 'Electronic Arts', 'In FIFA 18, the Frostbite 3 game engine returns. The game features 82 stadiums. Also, the PlayStation 4 and Xbox One versions include a continuation of \'The Journey\', a story-based mode.', 'images/26.jpeg'),
(27, 'FIFA 19', 'Sports', '2018-09-27', 'Electronic Arts', 'FIFA 19 brings you a conclusion to \'The Journey\' and all new game modes and features to enjoy on and offline. FIFA 19 allows you to take control in your very own footballing world.', 'images/27.jpg'),
(28, 'FIFA 20', 'Sports', '2019-09-27', 'Electronic Arts', 'FIFA 20 features over 30 official leagues, 90 fully licensed stadiums, and the new \'VOLTA Football\', a mode that provides a variance on the traditional 11v11 gameplay and focuses on small-sided street and futsal games.', 'images/28.jpeg'),
(29, 'FIFA 21', 'Sports', '2020-10-09', 'Electronic Arts', '28th installment in the FIFA series, introducing Ultimate Team, which features 100 icon players, Career Mode with new additions, and more.', 'images/29.jpg'),
(30, 'FIFA 22', 'Sports', '2021-10-01', 'Electronic Arts', 'FUT 22 redesigns Division Rivals and FUT Champions to create a more accessible way to test your skills and progress against other players, gives you even more ways to make your club your own with new depths of customisation both on and off the pitch, and introduces FUT Heroes.', 'images/30.jpg'),
(31, 'FIFA 23', 'Sports', '2022-09-30', 'Electronic Arts', 'FIFA 23 is a football simulation video game. It is the 30th installment in the FIFA series that is developed by EA Sports, and the final installment under the FIFA banner.', 'images/31.jpg'),
(32, 'EA FC 24', 'Sports', '2023-09-29', 'Electronic Arts', 'FC continues on that same renown experience of gameplay modes, leagues, tournaments, clubs and athletes, along with Ultimate Team, Career Mode, Pro Clubs and VOLTA Football.', 'images/32.jpg'),
(33, 'eFootball', 'Sports', '2021-09-30', 'Electronic Arts', 'In this game, you will be able to choose your favorite players and managers that will form your dream team. Select a manager that applies your favorite formation and tactics, train your players to ensure they are at their peak performance, and take on the world. There will be a plethora of weekly tournaments that are based on real-world matchups, providing an exciting experience for everyone.', 'images/33.jpg'),
(34, 'For Honor ', 'Action', '2017-02-14', 'Ubisoft Entertainment Inc.', 'For Honor is an action game developed by Ubisoft Montreal. The game mixes the element of fighting and hacks and slashes with a heavy focus on multiplayer.', 'images/34.jpg'),
(35, 'Injustice 2', 'Fighting', '2017-05-16', 'NetherRealm Studios', 'Batman and his allies work towards putting the pieces of society back together while struggling against those who want to restore Superman\'s regime. In the midst of the chaos, a new threat appears that will put Earth\'s existence at risk.', 'images/35.jpg'),
(36, 'Hades ', 'Role-playing', '2018-12-06', 'Supergiant Games, Inc.', 'Hades is a rogue-like dungeon crawler from the creators of Bastion and Transistor, in which you defy the god of death as you hack and slash your way out of the Underworld of Greek myth.', 'images/36.jpg'),
(37, 'WWE Smackdown! Here Comes the Pain', 'Sports', '2003-10-27', 'Yuke\'s Co. Ltd.', 'Choose from up to 55 WWE superstars and wrestle with the 2003 roster. The game features real-life attributes of strength, submission, technique, speed and stamina for each wrestler.', 'images/37.jpg'),
(38, 'WWE 2K24', 'Sports', '2024-03-08', 'Visual Concepts Entertainment, Inc.', 'WWE 2K24 is a professional wrestling sports video game developed by Visual Concepts and published by 2K. Experience a gripping retelling of WrestleMania\'s greatest moments in 2K Showcase of the Immortals, where you can relive a collection of some of the most unforgettable, career-defining matches.', 'images/38.png'),
(39, 'Dragon Ball: Xenoverse', 'Role-playing', '2019-02-05', 'Dimps', 'History is changing. The time-line is being altered, with villains becoming more powerful and defeating the Z warriors, when Trunks has put together a group of fighters known as the Time Patrol.', 'images/39.jpg'),
(40, 'Dragon Ball: Xenoverse 2', 'Role-playing', '2016-10-25', 'Dimps', 'Dragon Ball Xenoverse 2 gives players the ultimate Dragon Ball gaming experience. Develop your own warrior, create the perfect avatar, train to learn new skills and help fight new enemies to restore the original story of the DRAGON BALL series. Join 300 players from around the world in the new hub city of Conton and fight with or against them.', 'images/40.jpeg'),
(41, 'Dragon Ball Z: Kakarot', 'Role-playing', '2020-01-17', 'CyberConnect2', 'Play as the legendary Saiyan Son Goku \'Kakarot\' as you relive his story and explore the world.', 'images/41.png'),
(42, 'Cyberpunk 2077', 'Role-playing', '2020-12-10', 'CD Projekt RED', 'In Night City, a mercenary known as V navigates a dystopian society in which the line between humanity and technology becomes blurred.', 'images/42.jpg'),
(43, 'Red Dead Redemption', 'Open world', '2010-05-18', 'Rockstar Games, Inc.', 'Red Dead Redemption is a third-person open-world adventure game which implements the Wild West at its best: it is very much GTA-clone but in bizarre stylistics and the very beginning of the twentieth century', 'images/43.jpg'),
(44, 'Red Dead Redemption II', 'Open world', '2018-10-26', 'Rockstar Games, Inc.', 'Amidst the decline of the Wild West at the turn of the 20th century, outlaw Arthur Morgan and his gang struggle to cope with the loss of their way of life.', 'images/44.jpg'),
(45, 'Grand Theft Auto: Vice City', 'Open world', '2002-10-29', 'Rockstar Games, Inc.', 'After being released from jail, Tommy Vercetti leaves Liberty City for Vice City, a city overrun by the mob. Now, Tommy is out to make Vice City his home.', 'images/45.jpg'),
(46, 'Grand Theft Auto: San Andreas', 'Open world', '2004-10-26', 'Rockstar Games, Inc.', 'After five years on the east coast, Carl Johnson returns to the city of Los Santos, San Andreas to find numerous fellow gang-members dead and enemy gangs having dominance of the city. Carl must take over the city and get his old gang back on top before the city destroys itself.', 'images/46.jpg'),
(47, 'Grand Theft Auto V', 'Open world', '2007-09-13', 'Rockstar Games, Inc.', 'Three very different criminals team up for a series of heists and walk into some of the most thrilling experiences in the corrupt city of Los Santos.', 'images/47.png'),
(48, 'Rocket League ', 'Racing', '2015-07-07', 'Psyonix, Inc.', 'A physics-based online game where players engage in soccer-type matches using rocket powered, customizable cars.', 'images/48.jpg'),
(49, 'Fortnite ', 'Shooter', '2017-07-21', 'Epic Games, Inc.', 'A cooperative shooter-survival game for up to four players to fight off zombie-like husks, defend objects with fortifications you can build, and a battle royale mode where up to 100 players fight to be the last person standing.', 'images/49.jpeg'),
(50, 'PlayerUnknown\'s Battlegrounds', 'Shooter', '2017-03-23', 'PUBG Corporation', 'A Battle Royale begins when one hundred players parachute onto an island.', 'images/50.png'),
(51, 'Sekiro: Shadows Die Twice', 'Adventure', '2019-03-22', 'FromSoftware, Inc.', 'Set in a reimagining of 1500s Sengoku era Japan. An unnamed shinobi, tasked with protecting a young lord of mystical lineage, who is left for dead when a powerful samurai attacks and chops off his arm.', 'images/51.jpg'),
(52, 'The Witcher 3: Wild Hunt', 'Adventure', '2015-05-19', 'CD Projekt RED', 'The monster slayer Geralt of Rivia must find his adoptive daughter who is being pursued by the Wild Hunt, and prevent the White Frost from bringing about the end of the world.', 'images/52.jpg'),
(53, 'Marvel\'s Spider-Man', 'Adventure', '2018-09-07', 'Insomniac Games', 'When a new villain threatens New York City, Peter Parker and Spider-Man\'s worlds collide. To save the city and those he loves, he must rise up and be greater.', 'images/53.jpg'),
(54, 'Marvel\'s Spider-Man: Miles Morales', 'Adventure', '2020-11-12', 'Insomniac Games', 'Taking on Spider-Man\'s duties while Peter is in Europe, Miles Morales will learn what it takes to be the Friendly Neighbourhood\'s Wall Crawler, and will know what it is to be a superhero New York looks up to; even during the Christmas Season. One Spider-Man is on break; another takes his place.', 'images/54.jpeg'),
(55, 'Marvel Spider-Man 2', 'Adventure', '2023-10-19', 'Insomniac Games', 'Spider-Men, Peter Parker and Miles Morales, return for an exciting new adventure in the critically acclaimed Marvel\'s Spider-Man franchise.', 'images/55.jpeg'),
(56, 'God of War', 'Adventure', '2005-03-22', 'SCE Studio Santa Monica', 'After 10 years of endless nightmares and servitude to the gods of Olympus, Kratos is assigned with a final task, to kill Ares, the God of War.', 'images/56.jpg'),
(57, 'God of War', 'Adventure', '2018-04-20', 'SIE Santa Monica Studio', 'After wiping out the gods of Mount Olympus, Kratos moves on to the frigid lands of Scandinavia, where he and his son must embark on an odyssey across a dangerous world of gods and monsters.', 'images/57.jpg'),
(58, 'God of War: Ragnar?k', 'Adventure', '2022-11-09', 'SIE Santa Monica Studio', 'Kratos and his son Atreus face the oncoming Norse apocalypse, Ragnarok.', 'images/58.jpg'),
(59, 'Final Fantasy VII: Remake', 'Role-playing', '2020-04-10', 'Square Enix Co., Ltd.', 'FINAL FANTASY VII REMAKE is a reimagining of the iconic original with unforgettable characters, a mind-blowing story, and epic battles. The story of this first, standalone game in the FINAL FANTASY VII REMAKE project covers up to the party\'s escape from Midgar, and goes deeper into the events occurring in Midgar than the original FINAL FANTASY VII.', 'images/59.png'),
(60, 'League of Legends ', 'Strategy', '2009-10-27', 'Riot Games, Inc.', 'Assume the role of an unseen summoner and battle against a team of other players or computer-controlled champions in the immensely popular multiplayer online battle arena League of Legends.', 'images/60.jpg'),
(61, 'Titanfall 2', 'Shooter', '2016-10-28', 'Respawn Entertainment LLC', 'At the edge of the Frontier, a Titan and a common footsoldier are unexpectedly thrown together in a desperate attempt to prevent a catastrophic event.', 'images/61.jpg'),
(62, 'Animal Crossing: New Horizons', 'Simulator', '2020-03-19', 'Nintendo EPD', 'A nonlinear life simulator played in real-time. The player assumes the role of a customizable character who moves to a deserted island after purchasing a vacation package from Tom Nook, a raccoon character who is a staple of the series.', 'images/62.jpg'),
(63, 'Resident Evil 2', 'Shooter', '2019-01-25', 'Capcom Development Division 1', 'Raccoon City is on fire, and only two people have a fighting chance of making it out alive: Leon Kennedy and Claire Redfield. In a race against time and the Umbrella Corporation, the two must stop the spread of the G-Virus before the rest of the world is infected.', 'images/63.jpg'),
(64, 'Mortal Kombat 11: Aftermath', 'Fighting', '2020-05-26', 'NetherRealm Studios', 'When a time lord starts merging past with the present, versions of heroes from both Mortal Kombat timelines must unite to right past wrongs and save the world.', 'images/64.png'),
(65, 'The Sims 4', 'Role-playing', '2014-09-02', 'Maxis', 'Fourth main game in the real-time life simulation / management series, with an expanded character creation process.', 'images/65.png'),
(66, 'Silent Hill 2', 'Adventure', '2012-03-20', 'Hijinx Studios', 'After receiving a letter from his late wife, from Silent Hill, James Sunderland heads towards the town to search for her, only to come across a terrifying road of truth and redemption.', 'images/66.jpg'),
(67, 'XCOM 2', 'Simulator', '2016-02-04', 'Firaxis Games', 'Twenty years have passed since world leaders offered an unconditional surrender to alien forces. But at the edges of the world a force gathers once again to stand up for humanity.', 'images/67.jpg'),
(68, 'Batman: Arkham City', 'Adventure', '2011-10-18', 'Rocksteady Studios', 'When part of Gotham is turned into a private reserve for criminals known as Arkham City, all hell is sure to break loose, and the Dark Knight is the only one who can stop it.', 'images/68.jpeg'),
(69, 'Dishonored 2', 'Adventure', '2016-11-11', 'Arkane Studios', 'Dishonored 2 starts off when Emily is about to become the new Empress. Yet, all hopes for a better future are destroyed, when her aunt makes an appearance. Emily and her father are blamed for killing the enemies of the throne. Now it is up to Corvo Attano, or Emily Kaldwin to save the Empire of the Isles from the bloody reign of Delilah.', 'images/69.jpg'),
(70, 'Uncharted 4: A Thief\'s End', 'Adventure', '2016-05-10', 'Naughty Dog', 'Thrown back into the dangerous underworld he\'d tried to leave behind, Nathan Drake must decide what he\'s willing to sacrifice to save the ones he loves.', 'images/70.jpg'),
(71, 'Apex Legends', 'Shooter', '2019-02-04', 'Respawn Entertainment LLC', 'Master an ever-growing roster of legendary characters with powerful abilities and experience strategic squad play and innovative gameplay in the next evolution of Hero Shooter and Battle Royale.', 'images/71.jpg'),
(72, 'The Elder Scrolls V: Skyrim', 'Adventure', '2011-11-10', 'Bethesda Game Studios', 'After escaping execution, the last living Dragonborn must grow in strength and power to defeat the dragons that have once again begun to plague the land of Skyrim.', 'images/72.png'),
(73, 'Resident Evil 4', 'Shooter', '2011-09-08', 'Capcom Production Studio 4', 'Six years have passed since the biological disaster in Raccoon City. Agent Leon S. Kennedy, one of the survivors of the incident, has been sent to rescue the president\'s kidnapped daughter. He tracks her to a secluded European village, where there is something terribly wrong with the locals.', 'images/73.jpg'),
(74, 'The Last of Us Part II', 'Adventure', '2020-06-19', 'Naughty Dog', 'Five years after the events of The Last of Us, Ellie embarks on another journey through a post-apocalyptic America on a mission of vengeance against a mysterious militia.', 'images/74.png'),
(75, 'Minecraft', 'Simulator', '2017-09-20', 'Mojang Studios', 'Welcome to the world of Minecraft where you can build, brew potions, enchant your armor and tools and adventure other biomes. Visit the Nether, or even defeat the Ender Dragon in the End.', 'images/75.png');

-- --------------------------------------------------------

--
-- Table structure for table `game_list`
--

CREATE TABLE `game_list` (
  `list_id` int(11) NOT NULL,
  `entry_id` varchar(19) NOT NULL,
  `flag_allgames` int(11) DEFAULT NULL,
  `flag_plantoplay` int(11) DEFAULT NULL,
  `flag_currentlyplaying` int(11) DEFAULT NULL,
  `flag_completed` int(11) DEFAULT NULL,
  `flag_rating` int(11) DEFAULT NULL,
  `rating` decimal(3,2) DEFAULT NULL,
  `flag_review` int(11) DEFAULT NULL,
  `flag_dropped` int(11) DEFAULT NULL,
  `reeason_of_dropping` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `game_list`
--

INSERT INTO `game_list` (`list_id`, `entry_id`, `flag_allgames`, `flag_plantoplay`, `flag_currentlyplaying`, `flag_completed`, `flag_rating`, `rating`, `flag_review`, `flag_dropped`, `reeason_of_dropping`) VALUES
(3, '0843610040893', 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '470886747430932', 1, 0, 0, 1, NULL, 9.00, NULL, 0, NULL),
(4, '0956044183178', 1, NULL, 1, NULL, NULL, 8.00, 1, NULL, NULL),
(4, '876941920900', 1, NULL, NULL, 1, NULL, 9.00, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `platforms`
--

CREATE TABLE `platforms` (
  `game_id` int(11) NOT NULL,
  `platform` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `platforms`
--

INSERT INTO `platforms` (`game_id`, `platform`) VALUES
(1, 'PlayStation 2'),
(1, 'PlayStation 3'),
(1, 'Windows'),
(1, 'Xbox'),
(2, 'PlayStation 2'),
(2, 'PlayStation 3'),
(2, 'Windows'),
(2, 'Xbox'),
(3, 'PlayStation 2'),
(3, 'PlayStation 3'),
(3, 'PlayStation Portable'),
(3, 'Windows'),
(3, 'Xbox'),
(4, 'PlayStation 2'),
(4, 'PlayStation 3'),
(4, 'Windows'),
(4, 'Xbox 360'),
(5, 'PlayStation 2'),
(5, 'PlayStation 3'),
(5, 'Windows'),
(5, 'Xbox 360'),
(6, 'PlayStation 2'),
(6, 'PlayStation 3'),
(6, 'Windows'),
(6, 'Xbox 360'),
(7, 'PlayStation 2'),
(7, 'PlayStation 3'),
(7, 'Windows'),
(7, 'Xbox 360'),
(8, 'PlayStation Portable'),
(9, 'PlayStation 2'),
(9, 'PlayStation 3'),
(9, 'PlayStation 4'),
(9, 'Windows'),
(9, 'Xbox 360'),
(9, 'Xbox One'),
(10, 'PlayStation 4'),
(10, 'Windows'),
(10, 'Xbox One'),
(11, 'PlayStation 4'),
(11, 'Windows'),
(11, 'Xbox One'),
(12, 'PlayStation 4'),
(12, 'Windows'),
(12, 'Xbox One'),
(13, 'Nintendo Switch'),
(13, 'PlayStation 4'),
(13, 'Windows'),
(13, 'Xbox One'),
(14, 'Nintendo Switch'),
(14, 'PlayStation 4'),
(14, 'Windows'),
(14, 'Xbox One'),
(15, 'Linux'),
(15, 'Windows'),
(16, 'Windows'),
(17, 'Windows'),
(18, 'Windows'),
(19, 'Nintendo DS'),
(20, 'Windows'),
(21, 'Linux'),
(21, 'Windows'),
(22, 'PlayStation 3'),
(22, 'Windows'),
(22, 'Xbox 360'),
(23, 'PlayStation 4'),
(23, 'Windows'),
(23, 'Xbox One'),
(24, 'PlayStation 4'),
(24, 'Windows'),
(24, 'Xbox One'),
(25, 'PlayStation 4'),
(25, 'Windows'),
(25, 'Xbox One'),
(26, 'PlayStation 4'),
(26, 'Windows'),
(26, 'Xbox One'),
(27, 'PlayStation 4'),
(27, 'Windows'),
(27, 'Xbox One'),
(28, 'PlayStation 4'),
(28, 'Windows'),
(28, 'Xbox One'),
(29, 'Nintendo Switch'),
(29, 'PlayStation 4'),
(29, 'PlayStation 5'),
(29, 'Windows'),
(29, 'Xbox One'),
(29, 'Xbox Series S|X'),
(30, 'Nintendo Switch'),
(30, 'PlayStation 4'),
(30, 'PlayStation 5'),
(30, 'Windows'),
(30, 'Xbox One'),
(30, 'Xbox Series S|X'),
(31, 'Nintendo Switch'),
(31, 'PlayStation 4'),
(31, 'PlayStation 5'),
(31, 'Windows'),
(31, 'Xbox One'),
(31, 'Xbox Series S|X'),
(32, 'Nintendo Switch'),
(32, 'PlayStation 4'),
(32, 'PlayStation 5'),
(32, 'Windows'),
(32, 'Xbox One'),
(32, 'Xbox Series S|X'),
(33, 'PlayStation 4'),
(33, 'PlayStation 5'),
(33, 'Windows'),
(33, 'Xbox One'),
(33, 'Xbox Series S|X'),
(34, 'PlayStation 4'),
(34, 'Windows'),
(34, 'Xbox One'),
(35, 'PlayStation 4'),
(35, 'Windows'),
(35, 'Xbox One'),
(36, 'PlayStation 4'),
(36, 'Windows'),
(36, 'Xbox One'),
(37, 'PlayStation 2'),
(37, 'Windows'),
(38, 'PlayStation 4'),
(38, 'PlayStation 5'),
(38, 'Windows'),
(38, 'Xbox One'),
(38, 'Xbox Series S|X'),
(39, 'PlayStation 3'),
(39, 'PlayStation 4'),
(39, 'Windows'),
(39, 'Xbox 360'),
(39, 'Xbox One'),
(40, 'Nintendo Switch'),
(40, 'PlayStation 4'),
(40, 'Windows'),
(40, 'Xbox One'),
(41, 'Nintendo Switch'),
(41, 'PlayStation 4'),
(41, 'PlayStation 5'),
(41, 'Windows'),
(41, 'Xbox One'),
(41, 'Xbox Series S|X'),
(42, 'PlayStation 4'),
(42, 'PlayStation 5'),
(42, 'Windows'),
(42, 'Xbox One'),
(42, 'Xbox Series S|X'),
(43, 'PlayStation 3'),
(43, 'Windows'),
(43, 'Xbox 360'),
(44, 'PlayStation 4'),
(44, 'Windows'),
(44, 'Xbox One'),
(45, 'PlayStation 2'),
(45, 'Windows'),
(46, 'PlayStation 2'),
(46, 'Windows'),
(47, 'PlayStation 3'),
(47, 'PlayStation 4'),
(47, 'PlayStation 5'),
(47, 'Windows'),
(47, 'Xbox One'),
(47, 'Xbox Series S|X'),
(48, 'PlayStation 3'),
(48, 'PlayStation 4'),
(48, 'PlayStation 5'),
(48, 'Windows'),
(48, 'Xbox One'),
(48, 'Xbox Series S|X'),
(49, 'Android'),
(49, 'iOS'),
(49, 'PlayStation 4'),
(49, 'PlayStation 5'),
(49, 'Windows'),
(49, 'Xbox One'),
(49, 'Xbox Series S|X'),
(50, 'Android'),
(50, 'iOS'),
(50, 'PlayStation 4'),
(50, 'Windows'),
(50, 'Xbox One'),
(51, 'PlayStation 4'),
(51, 'Windows'),
(51, 'Xbox One'),
(52, 'Windows'),
(53, 'Nintendo Switch'),
(53, 'PlayStation 4'),
(53, 'PlayStation 5'),
(53, 'Xbox One'),
(53, 'Xbox Series S|X'),
(54, 'PlayStation 4'),
(55, 'PlayStation 5'),
(56, 'PlayStation 2'),
(57, 'PlayStation 4'),
(57, 'Windows'),
(58, 'PlayStation 4'),
(58, 'PlayStation 5'),
(59, 'PlayStation 4'),
(60, 'Windows'),
(61, 'PlayStation 4'),
(61, 'Windows'),
(61, 'Xbox One'),
(62, 'Nintendo Switch'),
(63, 'PlayStation 4'),
(63, 'PlayStation 5'),
(63, 'Windows'),
(63, 'Xbox One'),
(63, 'Xbox Series S|X'),
(64, 'PlayStation 4'),
(64, 'PlayStation 5'),
(64, 'Windows'),
(64, 'Xbox One'),
(64, 'Xbox Series S|X'),
(65, 'PlayStation 4'),
(65, 'Windows'),
(65, 'Xbox One'),
(66, 'PlayStation 3'),
(66, 'Xbox 360'),
(67, 'Linux'),
(67, 'PlayStation 4'),
(67, 'Windows'),
(67, 'Xbox One'),
(68, 'Nintendo Switch'),
(68, 'PlayStation 3'),
(68, 'Windows'),
(68, 'Xbox 360'),
(69, 'PlayStation 4'),
(69, 'Windows'),
(69, 'Xbox One'),
(70, 'PlayStation 4'),
(71, 'PlayStation 4'),
(71, 'PlayStation 5'),
(71, 'Windows'),
(71, 'Xbox One'),
(71, 'Xbox Series S|X'),
(72, 'PlayStation 3'),
(72, 'Windows'),
(72, 'Xbox 360'),
(73, 'PlayStation 3'),
(73, 'PlayStation 4'),
(73, 'Xbox 360'),
(73, 'Xbox One'),
(74, 'PlayStation 4'),
(75, 'Android'),
(75, 'iOS'),
(75, 'Nintendo Switch'),
(75, 'PlayStation 4'),
(75, 'Windows'),
(75, 'Xbox One');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  `entry_id` varchar(19) NOT NULL,
  `review` varchar(5000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `list_id`, `entry_id`, `review`) VALUES
(13, 4, '0956044183178', 'Very sophisticated');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `list_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `firstname`, `lastname`, `password`, `email`, `dob`, `list_id`) VALUES
(9924, 'Salim', 'Miah', 'salim123', 'salim.miah@g.bracu.ac.bd', '2002-08-08', 3),
(730395, 'Fariha Binte', 'Abdullah', 'fariha123', 'fariha.binte.abdullah@gmail.co', '2002-07-13', 5),
(774988, 'Tamim', 'Ahmed', 'tamim123', 'tamim.ahmed@gmail.com', '2014-12-29', 4),
(34103801, 'taylor', 'swift', 'root', 'taylor@gmail.com', '1993-06-15', 2),
(2147483647, 'affshafee', 'rahman', 'jkl', 'affshafee14@gmail.com', '2001-06-14', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addinggames`
--
ALTER TABLE `addinggames`
  ADD PRIMARY KEY (`game_id`,`list_id`,`entry_id`),
  ADD KEY `list_id` (`list_id`,`entry_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `developers`
--
ALTER TABLE `developers`
  ADD PRIMARY KEY (`developer_name`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`user_id1`,`user_id2`),
  ADD KEY `user_id2` (`user_id2`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`game_id`),
  ADD KEY `developer` (`developer`);

--
-- Indexes for table `game_list`
--
ALTER TABLE `game_list`
  ADD PRIMARY KEY (`list_id`,`entry_id`);

--
-- Indexes for table `platforms`
--
ALTER TABLE `platforms`
  ADD PRIMARY KEY (`game_id`,`platform`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`,`list_id`,`entry_id`),
  ADD KEY `list_id` (`list_id`,`entry_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `list_id` (`list_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `game_list`
--
ALTER TABLE `game_list`
  MODIFY `list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addinggames`
--
ALTER TABLE `addinggames`
  ADD CONSTRAINT `addinggames_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`),
  ADD CONSTRAINT `addinggames_ibfk_2` FOREIGN KEY (`list_id`,`entry_id`) REFERENCES `game_list` (`list_id`, `entry_id`);

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`user_id1`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`user_id2`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_ibfk_1` FOREIGN KEY (`developer`) REFERENCES `developers` (`developer_name`);

--
-- Constraints for table `platforms`
--
ALTER TABLE `platforms`
  ADD CONSTRAINT `platforms_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`list_id`,`entry_id`) REFERENCES `game_list` (`list_id`, `entry_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`list_id`) REFERENCES `game_list` (`list_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
