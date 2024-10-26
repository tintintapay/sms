function showInfo(sport) {
    var title = sport;
    var message;
  
    switch(sport) {
      case 'Basketball':
        message = "At Batangas State University, basketball is one of the most popular and competitive sports, with athletes representing the university in intercollegiate leagues. The sport encourages teamwork, leadership, and athleticism, with the university’s basketball teams consistently striving for excellence in regional tournaments.";
        break;
      case 'Volleyball':
        message = "Volleyball is a celebrated sport at BSU, with both men’s and women’s teams competing in various competitions. It fosters a strong sense of teamwork and coordination, and BSU's volleyball teams are known for their camaraderie and competitive spirit in university and provincial leagues.";
        break;
      case 'Football/Soccer':
        message = "As part of BSU’s commitment to holistic student development, football (soccer) is a growing sport that promotes endurance, strategy, and sportsmanship. The university's football teams are regularly involved in local and national competitions, building a reputation for skill and dedication.";
        break;
      case 'Badminton':
        message = "Badminton is a favored sport among BSU students for its fast-paced action and the physical and mental sharpness it demands. The university regularly holds tournaments, and its players represent BSU in intercampus and provincial competitions, fostering a strong community of athletes.";
        break;
      case 'Table Tennis':
        message = "Table tennis at BSU provides students with a platform to hone their quick reflexes, hand-eye coordination, and concentration. It is a sport where the university excels in regional matches, with skilled players representing the campus in competitive play.";
        break;
        case 'Tennis':
        message = "With its focus on individual skill and strategic thinking, tennis is an important sport at BSU, helping students develop stamina, agility, and focus. The university's tennis athletes participate in competitions, showcasing their talent on regional and national platforms.";
        break;
        case 'Athletics':
        message = "BSU’s athletics program offers students opportunities to compete in track and field events, such as sprints, distance running, and jumping events. The university encourages athletic excellence, and BSU athletes often participate in regional athletic meets, pushing their limits to achieve personal and team goals.";
        break;
        case 'Chess':
        message = "Chess at BSU promotes critical thinking, strategy, and patience. It is a beloved intellectual sport, with university representatives competing in provincial chess tournaments and consistently performing well, demonstrating their sharp minds and tactical expertise.";
        break;
        case 'Taekwondo':
        message = "BSU proudly supports Taekwondo as a sport that teaches discipline, respect, and self-defense. The university's Taekwondo team participates in inter-university competitions, where they showcase their skills and physical prowess, earning recognition for their dedication to the sport.";
        break;
        case 'Swimming':
        message = "BSU’s swimming team represents the university in various competitions, excelling in individual and relay events. Swimming promotes strength and endurance, and BSU athletes train rigorously to excel in this highly competitive sport at regional and national levels.";
        break;
        case 'Sepak Takraw':
        message = "Sepak Takraw is a unique sport that BSU athletes take pride in, combining agility and acrobatic skill. The university encourages students to master this traditional Southeast Asian sport, and BSU teams regularly participate in competitions, displaying remarkable talent in local games.";
        break;
        case 'Softball/Baseball':
        message = "Softball and baseball are popular team sports at BSU, promoting teamwork, strategy, and precision. The university's teams are active in regional leagues, often competing with neighboring universities, and contributing to the rich athletic culture of BSU.";
        break;
        case 'Arnis':
        message = "As the national martial art of the Philippines, Arnis holds a special place at BSU, where students are trained in the art of self-defense and combat. The university’s Arnis team often competes in martial arts tournaments, proudly representing BSU and preserving Filipino cultural heritage.";
        break;
        case 'Dance Sports':
        message = "Dance Sports at BSU combines athleticism with artistic expression, with student dancers excelling in both local and national competitions. The university hosts dance sports events where students display their creativity and coordination in dances like cha-cha and tango.";
        break;
        case 'Pencak Silat':
        message = "Pencak Silat is an emerging martial art at BSU that emphasizes fluid movement and self-discipline. The university promotes the sport as a way to engage students in both physical fitness and cultural appreciation, with athletes participating in various competitions.";
        break;
        case 'Karate':
        message = "Karate at BSU is a platform for students to develop self-discipline, focus, and self-defense skills. The university’s karatekas compete in regional tournaments, bringing pride to BSU through their discipline and technical abilities, while also promoting the martial art across campus.";
        break;
      default:
        message = "Information about this sport is not available.";
    }
    
    document.getElementById('popup-title').textContent = title;
    document.getElementById('popup-message').textContent = message;
    
    document.getElementById('popup').style.display = 'flex';
  }
  
  function closePopup() {
    document.getElementById('popup').style.display = 'none';
  }
  