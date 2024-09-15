function showInfo(sport) {
    var title = sport;
    var message;
  
    switch(sport) {
      case 'Basketball':
        message = "Basketball is a team sport where players score points by shooting a ball through a hoop.";
        break;
      case 'Soccer':
        message = "Soccer, also known as football, is a team sport where players score goals by getting a ball into the opposing team's net.";
        break;
      case 'Tennis':
        message = "Tennis is a racket sport that can be played individually against a single opponent or between two teams of two players each.";
        break;
      case 'Baseball':
        message = "Baseball is a bat-and-ball game played between two teams who take turns batting and fielding.";
        break;
      case 'Swimming':
        message = "Swimming is an individual or team sport that requires the use of one's entire body to move through water.";
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
  