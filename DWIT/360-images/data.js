var APP_DATA = {
  "scenes": [
    {
      "id": "0-main-entrance",
      "name": "Welcome to DWIT",
      "levels": [
        {
          "tileSize": 256,
          "size": 256,
          "fallbackOnly": true
        },
        {
          "tileSize": 512,
          "size": 512
        },
        {
          "tileSize": 512,
          "size": 1024
        },
        {
          "tileSize": 512,
          "size": 2048
        }
      ],
      "faceSize": 1800,
      "initialViewParameters": {
        "pitch": 0,
        "yaw": 0,
        "fov": 1.5707963267948966
      },
      "linkHotspots": [
        {
          "yaw": 0.2299786891917961,
          "pitch": -0.053862157787254006,
          "rotation": 0,
          "target": "2-parking-area"
        },
        {
          "yaw": 1.8373824833375263,
          "pitch": -0.06527952184685759,
          "rotation": 0,
          "target": "3-terrace"
        }
      ],
      "infoHotspots": []
    },
    {
      "id": "1-basketball-court",
      "name": "Court",
      "levels": [
        {
          "tileSize": 256,
          "size": 256,
          "fallbackOnly": true
        },
        {
          "tileSize": 512,
          "size": 512
        },
        {
          "tileSize": 512,
          "size": 1024
        },
        {
          "tileSize": 512,
          "size": 2048
        }
      ],
      "faceSize": 1800,
      "initialViewParameters": {
        "yaw": 2.927036700222226,
        "pitch": -0.1137506297026718,
        "fov": 1.2066849832423883
      },
      "linkHotspots": [
        {
          "yaw": -0.900246335414927,
          "pitch": -0.05993152390851364,
          "rotation": 0,
          "target": "2-parking-area"
        }
      ],
      "infoHotspots": []
    },
    {
      "id": "2-parking-area",
      "name": "Parking Lot",
      "levels": [
        {
          "tileSize": 256,
          "size": 256,
          "fallbackOnly": true
        },
        {
          "tileSize": 512,
          "size": 512
        },
        {
          "tileSize": 512,
          "size": 1024
        },
        {
          "tileSize": 512,
          "size": 2048
        }
      ],
      "faceSize": 1800,
      "initialViewParameters": {
        "pitch": 0,
        "yaw": 0,
        "fov": 1.5707963267948966
      },
      "linkHotspots": [
        {
          "yaw": -0.8886301822349107,
          "pitch": 0.052531069814786946,
          "rotation": 0,
          "target": "0-main-entrance"
        },
        {
          "yaw": -1.5901036010330891,
          "pitch": 0.002033438749759142,
          "rotation": 0,
          "target": "1-basketball-court"
        }
      ],
      "infoHotspots": []
    },
    {
      "id": "3-terrace",
      "name": "Patio",
      "levels": [
        {
          "tileSize": 256,
          "size": 256,
          "fallbackOnly": true
        },
        {
          "tileSize": 512,
          "size": 512
        },
        {
          "tileSize": 512,
          "size": 1024
        },
        {
          "tileSize": 512,
          "size": 2048
        }
      ],
      "faceSize": 1800,
      "initialViewParameters": {
        "yaw": -2.289278807016011,
        "pitch": -0.15671563343970618,
        "fov": 1.2066849832423883
      },
      "linkHotspots": [
        {
          "yaw": 2.6242409223870506,
          "pitch": -0.050838184938227116,
          "rotation": 0,
          "target": "0-main-entrance"
        },
        {
          "yaw": -2.221791691858991,
          "pitch": 0.022230215870788328,
          "rotation": 0,
          "target": "16-open-area"
        }
      ],
      "infoHotspots": []
    },
    {
      "id": "4-first-floor-stairs",
      "name": "Stairway Floor 1",
      "levels": [
        {
          "tileSize": 256,
          "size": 256,
          "fallbackOnly": true
        },
        {
          "tileSize": 512,
          "size": 512
        },
        {
          "tileSize": 512,
          "size": 1024
        },
        {
          "tileSize": 512,
          "size": 2048
        }
      ],
      "faceSize": 1800,
      "initialViewParameters": {
        "pitch": 0,
        "yaw": 0,
        "fov": 1.5707963267948966
      },
      "linkHotspots": [
        {
          "yaw": -1.25761407818041,
          "pitch": 0.20440012597133617,
          "rotation": 0,
          "target": "5-first-floor-balcony"
        },
        {
          "yaw": 1.9649093667518756,
          "pitch": -0.12830500355208407,
          "rotation": 0,
          "target": "14-second-floor-stairs"
        },
        {
          "yaw": 2.5422104914826518,
          "pitch": 0.432956741601604,
          "rotation": 0,
          "target": "16-open-area"
        }
      ],
      "infoHotspots": []
    },
    {
      "id": "5-first-floor-balcony",
      "name": "Deck",
      "levels": [
        {
          "tileSize": 256,
          "size": 256,
          "fallbackOnly": true
        },
        {
          "tileSize": 512,
          "size": 512
        },
        {
          "tileSize": 512,
          "size": 1024
        },
        {
          "tileSize": 512,
          "size": 2048
        }
      ],
      "faceSize": 1800,
      "initialViewParameters": {
        "yaw": 2.734871919008171,
        "pitch": 0.19184476677953022,
        "fov": 1.2066849832423883
      },
      "linkHotspots": [
        {
          "yaw": -0.5274808168221892,
          "pitch": 0.04912060144744501,
          "rotation": 0,
          "target": "4-first-floor-stairs"
        }
      ],
      "infoHotspots": []
    },
    {
      "id": "6-classroom",
      "name": "School Room",
      "levels": [
        {
          "tileSize": 256,
          "size": 256,
          "fallbackOnly": true
        },
        {
          "tileSize": 512,
          "size": 512
        },
        {
          "tileSize": 512,
          "size": 1024
        },
        {
          "tileSize": 512,
          "size": 2048
        }
      ],
      "faceSize": 1800,
      "initialViewParameters": {
        "pitch": 0,
        "yaw": 0,
        "fov": 1.5707963267948966
      },
      "linkHotspots": [
        {
          "yaw": -0.48511780640189883,
          "pitch": -0.053243518168756054,
          "rotation": 0,
          "target": "9-corridor"
        }
      ],
      "infoHotspots": []
    },
    {
      "id": "7-club-room",
      "name": "Club Area",
      "levels": [
        {
          "tileSize": 256,
          "size": 256,
          "fallbackOnly": true
        },
        {
          "tileSize": 512,
          "size": 512
        },
        {
          "tileSize": 512,
          "size": 1024
        },
        {
          "tileSize": 512,
          "size": 2048
        }
      ],
      "faceSize": 1800,
      "initialViewParameters": {
        "yaw": 1.2729723979611212,
        "pitch": -0.06826633142098615,
        "fov": 1.2066849832423883
      },
      "linkHotspots": [
        {
          "yaw": 2.912973899911748,
          "pitch": 0.028659848695038903,
          "rotation": 0,
          "target": "10-library"
        },
        {
          "yaw": -2.398692685459528,
          "pitch": 0.09685832079049561,
          "rotation": 0,
          "target": "8-corridor"
        }
      ],
      "infoHotspots": []
    },
    {
      "id": "8-corridor",
      "name": "Corridor 1",
      "levels": [
        {
          "tileSize": 256,
          "size": 256,
          "fallbackOnly": true
        },
        {
          "tileSize": 512,
          "size": 512
        },
        {
          "tileSize": 512,
          "size": 1024
        },
        {
          "tileSize": 512,
          "size": 2048
        }
      ],
      "faceSize": 1800,
      "initialViewParameters": {
        "yaw": 1.1263213688151001,
        "pitch": -0.04910905060678772,
        "fov": 1.2066849832423883
      },
      "linkHotspots": [
        {
          "yaw": -2.2434521302599393,
          "pitch": 0.003861673203026328,
          "rotation": 0,
          "target": "9-corridor"
        },
        {
          "yaw": 1.1302486470305446,
          "pitch": -0.0006498756858146493,
          "rotation": 0,
          "target": "7-club-room"
        },
        {
          "yaw": 1.7205097036095598,
          "pitch": -0.17486452003557673,
          "rotation": 0,
          "target": "12-third-floor-view"
        },
        {
          "yaw": -1.7076565914083588,
          "pitch": -0.04851562990679881,
          "rotation": 0,
          "target": "13-staff-room"
        }
      ],
      "infoHotspots": []
    },
    {
      "id": "9-corridor",
      "name": "Corridor 2",
      "levels": [
        {
          "tileSize": 256,
          "size": 256,
          "fallbackOnly": true
        },
        {
          "tileSize": 512,
          "size": 512
        },
        {
          "tileSize": 512,
          "size": 1024
        },
        {
          "tileSize": 512,
          "size": 2048
        }
      ],
      "faceSize": 1800,
      "initialViewParameters": {
        "yaw": 2.622699283730526,
        "pitch": 0.05821353766804194,
        "fov": 1.2066849832423883
      },
      "linkHotspots": [
        {
          "yaw": 3.0857113465618724,
          "pitch": -0.027118062869279314,
          "rotation": 0,
          "target": "8-corridor"
        },
        {
          "yaw": 1.687251316696658,
          "pitch": 0.04168174411567804,
          "rotation": 0,
          "target": "14-second-floor-stairs"
        },
        {
          "yaw": 2.650511136120558,
          "pitch": -0.04165436788449561,
          "rotation": 0,
          "target": "6-classroom"
        }
      ],
      "infoHotspots": []
    },
    {
      "id": "10-library",
      "name": "Library",
      "levels": [
        {
          "tileSize": 256,
          "size": 256,
          "fallbackOnly": true
        },
        {
          "tileSize": 512,
          "size": 512
        },
        {
          "tileSize": 512,
          "size": 1024
        },
        {
          "tileSize": 512,
          "size": 2048
        }
      ],
      "faceSize": 1800,
      "initialViewParameters": {
        "yaw": 1.3402228619139098,
        "pitch": 0.049415146243664054,
        "fov": 1.2066849832423883
      },
      "linkHotspots": [
        {
          "yaw": -2.094673547360255,
          "pitch": -0.028186358072746387,
          "rotation": 0,
          "target": "7-club-room"
        }
      ],
      "infoHotspots": []
    },
    {
      "id": "11-rooftop-view",
      "name": "Bird Eye View",
      "levels": [
        {
          "tileSize": 256,
          "size": 256,
          "fallbackOnly": true
        },
        {
          "tileSize": 512,
          "size": 512
        },
        {
          "tileSize": 512,
          "size": 1024
        },
        {
          "tileSize": 512,
          "size": 2048
        }
      ],
      "faceSize": 1800,
      "initialViewParameters": {
        "yaw": 0.15656250691251827,
        "pitch": -0.2122013902102502,
        "fov": 1.2066849832423883
      },
      "linkHotspots": [
        {
          "yaw": 1.5183715254383428,
          "pitch": 0.38861308194272937,
          "rotation": 0,
          "target": "15-sagarmatha-hall"
        }
      ],
      "infoHotspots": []
    },
    {
      "id": "12-third-floor-view",
      "name": "Upper Deck",
      "levels": [
        {
          "tileSize": 256,
          "size": 256,
          "fallbackOnly": true
        },
        {
          "tileSize": 512,
          "size": 512
        },
        {
          "tileSize": 512,
          "size": 1024
        },
        {
          "tileSize": 512,
          "size": 2048
        }
      ],
      "faceSize": 1800,
      "initialViewParameters": {
        "yaw": -0.06428552489118289,
        "pitch": 0.13636591291784228,
        "fov": 1.2066849832423883
      },
      "linkHotspots": [
        {
          "yaw": 0.7506967221253049,
          "pitch": -0.12904548648956649,
          "rotation": 0,
          "target": "15-sagarmatha-hall"
        },
        {
          "yaw": 0.9755001851721374,
          "pitch": 0.206979652939971,
          "rotation": 0,
          "target": "9-corridor"
        }
      ],
      "infoHotspots": []
    },
    {
      "id": "13-staff-room",
      "name": "Faculty Area",
      "levels": [
        {
          "tileSize": 256,
          "size": 256,
          "fallbackOnly": true
        },
        {
          "tileSize": 512,
          "size": 512
        },
        {
          "tileSize": 512,
          "size": 1024
        },
        {
          "tileSize": 512,
          "size": 2048
        }
      ],
      "faceSize": 1800,
      "initialViewParameters": {
        "yaw": -0.2652755496276029,
        "pitch": 0.125992595619298,
        "fov": 1.2066849832423883
      },
      "linkHotspots": [
        {
          "yaw": -3.110011489414237,
          "pitch": -0.06966587095140042,
          "rotation": 0,
          "target": "9-corridor"
        }
      ],
      "infoHotspots": []
    },
    {
      "id": "14-second-floor-stairs",
      "name": "Stairway Floor 2",
      "levels": [
        {
          "tileSize": 256,
          "size": 256,
          "fallbackOnly": true
        },
        {
          "tileSize": 512,
          "size": 512
        },
        {
          "tileSize": 512,
          "size": 1024
        },
        {
          "tileSize": 512,
          "size": 2048
        }
      ],
      "faceSize": 1800,
      "initialViewParameters": {
        "pitch": 0,
        "yaw": 0,
        "fov": 1.5707963267948966
      },
      "linkHotspots": [
        {
          "yaw": 2.3638668375515746,
          "pitch": 0.4221599335738695,
          "rotation": 0,
          "target": "4-first-floor-stairs"
        },
        {
          "yaw": -0.6806086881267195,
          "pitch": 0.120845388428517,
          "rotation": 0,
          "target": "9-corridor"
        }
      ],
      "infoHotspots": []
    },
    {
      "id": "15-sagarmatha-hall",
      "name": "School  Auditorium",
      "levels": [
        {
          "tileSize": 256,
          "size": 256,
          "fallbackOnly": true
        },
        {
          "tileSize": 512,
          "size": 512
        },
        {
          "tileSize": 512,
          "size": 1024
        }
      ],
      "faceSize": 1024,
      "initialViewParameters": {
        "yaw": 1.2295084907128597,
        "pitch": 0.1931881971766245,
        "fov": 1.2066849832423883
      },
      "linkHotspots": [
        {
          "yaw": 2.0001458811236663,
          "pitch": -0.08553790348002366,
          "rotation": 0,
          "target": "11-rooftop-view"
        },
        {
          "yaw": -2.7022270708842857,
          "pitch": 0.02991921753811866,
          "rotation": 0,
          "target": "12-third-floor-view"
        }
      ],
      "infoHotspots": []
    },
    {
      "id": "16-open-area",
      "name": "Courtyard ",
      "levels": [
        {
          "tileSize": 256,
          "size": 256,
          "fallbackOnly": true
        },
        {
          "tileSize": 512,
          "size": 512
        },
        {
          "tileSize": 512,
          "size": 1024
        }
      ],
      "faceSize": 1024,
      "initialViewParameters": {
        "yaw": -0.9270434956771822,
        "pitch": -0.20089653811491992,
        "fov": 1.2066849832423883
      },
      "linkHotspots": [
        {
          "yaw": -1.4001135202536723,
          "pitch": -0.022914008745694048,
          "rotation": 0,
          "target": "4-first-floor-stairs"
        },
        {
          "yaw": 3.0624317601367155,
          "pitch": 0.03255014628913955,
          "rotation": 0,
          "target": "3-terrace"
        }
      ],
      "infoHotspots": []
    }
  ],
  "name": "360-images",
  "settings": {
    "mouseViewMode": "drag",
    "autorotateEnabled": true,
    "fullscreenButton": true,
    "viewControlButtons": false
  }
};
