document.addEventListener('DOMContentLoaded', () => {
    const background = document.getElementById('background');
    const usedPositions = new Set(); // 生成された位置を記録するセット
    const maxRipples = 8; // 最大で生成する波紋の数
    let rippleCount = 0; // 現在の波紋の数
  
    function createRipple(x, y) {
      const ripple = document.createElement('div');
      ripple.className = 'ripple';
      ripple.style.width = '100px';
      ripple.style.height = '100px';
      ripple.style.left = `${x - 50}px`;
      ripple.style.top = `${y - 50}px`;
  
      // ランダムな青系統の色を生成
      const randomBlueColor = getRandomBlueColor();
      ripple.style.backgroundColor = randomBlueColor;
  
      background.appendChild(ripple);
  
      ripple.addEventListener('animationend', () => {
        ripple.remove();
        rippleCount--; // 波紋が消えたらカウントを減らす
      });
  
      // 位置を記録
      usedPositions.add(`${x},${y}`);
  
      rippleCount++; // 波紋の数を増やす
  
      // 最大数に達したら生成を停止する
      if (rippleCount >= maxRipples) {
        stopGeneratingRipples();
      }
    }
  
    function stopGeneratingRipples() {
      // 生成を停止する処理を記述
      // 例えば、タイマーをクリアする等の処理が必要になる場合があります。
      console.log('Reached maximum ripples. Stopping further generation.');
    }
  
    function getRandomInt(min, max) {
      return Math.floor(Math.random() * (max - min + 1)) + min;
    }
  
    function getRandomBlueColor() {
      const blueColors = [
        '#00FFFF', // 青緑
        '#000080', // ネイビーブルー
        '#ffff00', // キャデットブルー
        '#1E90FF', // ダークスカイブルー
        '#4682B4', // スチールブルー
        '#87CEEB', // スカイブルー
        '#6495ED', // コーンフラワーブルー
        '#4169E1', // ロイヤルブルー
        '#6A5ACD'  // スレートブルー
      ];
      const randomIndex = getRandomInt(0, blueColors.length - 1);
      return blueColors[randomIndex];
    }
  
    function generateRandomRipple() {
      let x, y;
  
      // 新しい位置を見つけるまでループ
      do {
        x = getRandomInt(0, window.innerWidth);
        y = getRandomInt(0, window.innerHeight);
      } while (usedPositions.has(`${x},${y}`));
  
      createRipple(x, y);
    }
  
    function generateRandomRipples() {
      // 最大数に達していなければ、波紋を生成
      if (rippleCount < maxRipples) {
        generateRandomRipple();
  
        // 次の波紋生成をランダムな間隔でスケジュール
        const randomInterval = getRandomInt(2000, 5000);
        setTimeout(() => {
          generateRandomRipples();
        }, randomInterval);
      }
    }
  
    generateRandomRipples(); // 初回呼び出し
  });
  