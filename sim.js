'use strict';

function fuckingRealConsoleTable(table) {
  if (!table.length) {
    console.log('(empty)');
  }
  else {
    table.forEach(function (item) {
      console.log(item);
    });
  }
}

let Units = {
  'warship': {
    1: {
      'name'    : 'Chasseur',
      'hp'      : 10,
      'attack'  : 5,
      'defense' : 4,
      'cost'    : 1000
    },
    2: {
      'name'    : 'Croiseur',
      'hp'      : 25,
      'attack'  : 10,
      'defense' : 8,
      'cost'    : 1000
    },
    3: {
      'name'    : 'Destroyer',
      'hp'      : 50,
      'attack'  : 15,
      'defense' : 12,
      'cost'    : 3500
    }
  },
  'defense': {
     1: {
      'name'    : 'Lance-missiles',
      'hp'      : 12,
      'attack'  : 4,
      'defense' : 5,
      'cost'    : 1100
    },
    2: {
      'name'    : 'Laser léger',
      'hp'      : 29,
      'attack'  : 8,
      'defense' : 10,
      'cost'    : 2400
    },
    3: {
      'name'    : 'Destroyer',
      'hp'      : 62,
      'attack'  : 12,
      'defense' : 15,
      'cost'    : 3800
    }
  }
};

function sim(attackerFleet, defenderFleet) {
  // as the result of the sim, we want:
  // * amount of remaining units
  // * total cost of both fleet
  // * damage dealt by each side

  // attacker and defender sets:
  // [ { type: <warship|defense>, id: <int>, amount: <int> }, … ]

  let attacker = {
    name: 'attacker',
    debugStyle: 'color: #F44',
    currentFleet: attackerFleet
  };
  let defender = {
    name: 'defender',
    debugStyle: 'color: #88F',
    currentFleet: defenderFleet
  };
  let cycles = [ [ attacker, defender ], [ defender, attacker] ];

  var round = 1;
  while (attacker.currentFleet.length && defender.currentFleet.length) {
    console.log('============ round %d ================', round);

    // --- step 1: calculating total attack and defense points ---------

    cycles.forEach(function (players) {
      players[0].totalAttack = 0;
      players[0].totalDefense = 0;
      players[0].currentFleet.forEach(function (unit) {
        let data;
        try {
          data = Units[unit.type][unit.id];
        } catch (err) {
          console.error('Bad %s fleet', player[0].name, err);
        }
        players[0].totalAttack  += data.attack  * unit.amount;
        players[0].totalDefense += data.defense * unit.amount;
      });
      console.log('%ctotal %s attack: %d\ndefense: %d',
        players[0].debugStyle, players[0].name,
        players[0].totalAttack, players[0].totalDefense);
    });

    // --- step 2: calculating damage ----------------------------------

    cycles.forEach(function (players) {
      players[0].damage = players[0].totalAttack - players[1].totalDefense;
      if (players[0].damage < 0) players[0].damage = 0;
      players[1].damage = players[1].totalAttack - players[0].totalDefense;
      if (players[1].damage < 0) players[1].damage = 0;
      players.forEach(function (player) {
        console.log('%c%s damage: %d',
          player.debugStyle, player.name, player.damage);
      });
    });

    // --- step 3: determining units to be destroyed  ------------------
    let unitsHaveBeenDestroyed = false;

    cycles.forEach(function (players) {
      players[0].lostUnits = [];
      players[0].currentFleet.map(function (unit) {
        return {
          'hp'     : Units[unit.type][unit.id].hp,
          'id'     : unit.id,
          'type'   : unit.type,
          'amount' : unit.amount
        };
      })
      .sort(function (unitA, unitB) {
        return unitB.hp - unitA.hp;
      })
      .forEach(function (unit) {
        let loss = Math.floor(players[1].damage / unit.hp);
        if (loss < 0) throw new Error('negative loss');
        if (loss > 0) {
          unitsHaveBeenDestroyed = true;
          let actualLoss = Math.min(loss, unit.amount);
          if (actualLoss < 0) throw new Error('negative actualLoss');

          players[0].lostUnits.push({
            type : unit.type,
            id   : unit.id,
            loss : actualLoss
          });
          let actualDamage = actualLoss * unit.hp;
          if (actualDamage < 0) throw new Error('negative actualDamage');

          console.log('%c%s actualDamage: %d',
            players[1].debugStyle, players[1].name, actualDamage);
          players[1].damage -= actualDamage;
          if (players[1].damage < 0) {
            throw new Error('negative ' + players[1].name + ' damage');
          }
          console.log('%cremaining %s damage: %d',
            players[1].debugStyle, players[1].damage);
        }
      });
      console.log('%c%s lost units:', players[0].debugStyle, players[0].name);
      fuckingRealConsoleTable(players[0].lostUnits);
    });

    // --- step 4: removing destroyed units ----------------------------

    cycles.forEach(function (players) {
      players[0].lostUnits.forEach(function (lostUnit) {
        for (let i = 0; i < players[0].currentFleet.length; i++) {
          let currentUnit = players[0].currentFleet[i];
          if (currentUnit.id === lostUnit.id &&
              currentUnit.type === lostUnit.type) {
            if (lostUnit.loss > currentUnit.amount) {
              throw new Error('too many lost units');
            }
            currentUnit.amount -= lostUnit.loss;
            if (currentUnit.amount === 0) {
              players[0].currentFleet.splice(i, 1);
              i--;
            }
          }
        }
      });
      console.log('%c%s at the end of the round:',
        players[0].debugStyle, players[0].name);
      fuckingRealConsoleTable(players[0].currentFleet);
    });

    console.log('======== end of round %d =============', round);
    round++;

    if (!unitsHaveBeenDestroyed) break;
  }
}
