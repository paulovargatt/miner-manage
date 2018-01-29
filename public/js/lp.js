var urlEthMiner = '/json-eth-lp';
var urlCoinMarket = 'https://api.coinmarketcap.com/v1/ticker/ethereum/?convert=BRL';

power = [100,5]

function configEth(data, power) {
  for (var i = 0; i < power.length; i++){
    var netHash = data.nethash;
    var dificult = data.difficulty;
    var dificult24 = data.difficulty24;
    netHash = (netHash / dificult) * dificult24;
    var hashPower = (power[i] * 1e6) / netHash;
    var blockTime = data.block_time;
    var blockReward = data.block_reward24;
    var blocksPerMin = 60 / blockTime;
    var coinPermine = blocksPerMin * blockReward;
    var ganho = hashPower * coinPermine;
    var ganhoDia = ganho * 60 * 24;
    resulGanho = ganhoDia.toFixed(6);
    var  dia = ganhoDia ;
        if (power[i] === 100){
            $('#ganho_Dia').text(dia.toFixed(6));
            var mesGanho = ganhoDia * 30;
            $('#mes_ganho').text(mesGanho.toFixed(6));
            var anoGanho = ganhoDia * 365;
            $('#ano_ganho').text(anoGanho.toFixed(6));
            var twoYear = ganhoDia * 730;
            $('#twoYear_ganho').text(twoYear.toFixed(6));
            getEthPriceBR(resulGanho, power[i]);
        }else if (power[i] === 5) {
            $('#ganho_DiaCinco').text(dia.toFixed(6));
            var  mesGanho = ganhoDia * 30;
            $('#mes_ganhoCinco').text(mesGanho.toFixed(6));
            var  anoGanho = ganhoDia * 365;
            $('#ano_ganhoCinco').text(anoGanho.toFixed(6));
            var  twoYear = ganhoDia * 730;
            $('#twoYear_ganhoCinco').text(twoYear.toFixed(6));
            getEthPriceBR(resulGanho, power[i]);
        }
  }
}

function getEthPriceBR(resulGanho, power) {
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: urlCoinMarket,
        success: function (data) {
            ethValueBr = data[0].price_brl;
              if(power === 100 ) {
                  var ganhoDiaBr = resulGanho * parseFloat(ethValueBr);
                  $('#ganho_Dia_br').text('R$: ' + ganhoDiaBr.toFixed(2));
                  var ganhoSemanaBr = resulGanho * 7 * parseFloat(ethValueBr);
                  $('#semana_ganho_br').text('R$: ' + ganhoSemanaBr.toFixed(2));
                  var ganhoMesBr = resulGanho * 30 * parseFloat(ethValueBr);
                  $('#mes_ganho_br').text('R$: ' + ganhoMesBr.toFixed(2));
                  var ganhoAnoBr = resulGanho * 365 * parseFloat(ethValueBr);
                  $('#ano_ganho_br').text('R$: ' + ganhoAnoBr.toFixed(2));
                  var ganhoTwoBr = resulGanho * 730 * parseFloat(ethValueBr);
                  $('#twoYear_ganho_br').text('R$: ' + ganhoTwoBr.toFixed(2));
                  $('#twoYear_ganho_br_span').text('R$: ' + ganhoTwoBr.toFixed(2));
            }
            else if(power === 5 ){
                  var ganhoDiaBr = resulGanho * parseFloat(ethValueBr);
                  $('#ganho_Dia_brCinco').text('R$: ' + ganhoDiaBr.toFixed(2));
                  var ganhoSemanaBr = resulGanho * 7 * parseFloat(ethValueBr);
                  $('#semana_ganho_brCinco').text('R$: ' + ganhoSemanaBr.toFixed(2));
                  var ganhoMesBr = resulGanho * 30 * parseFloat(ethValueBr);
                  $('#mes_ganho_brCinco').text('R$: ' + ganhoMesBr.toFixed(2));
                  var ganhoAnoBr = resulGanho * 365 * parseFloat(ethValueBr);
                  $('#ano_ganho_brCinco').text('R$: ' + ganhoAnoBr.toFixed(2));
                  var ganhoTwoBr = resulGanho * 730 * parseFloat(ethValueBr);
                  $('#twoYear_ganho_brCinco').text('R$: ' + ganhoTwoBr.toFixed(2));
            }
        }
    });
}

function getEth(power) {
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: urlEthMiner,
        success: function (data) {
            configEth(data, power);
        }
    });
}
getEth(power);


