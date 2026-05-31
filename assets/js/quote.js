const quotes = [
    "誰かの正論は、時に自分自身を傷つける",
    "振り返って感謝すればいい",
    "遊びが大事",
    "私が成果を出せるのは時間の問題",
    "短期的な快楽は、長期的な不快感の原因になる",
    "人が多すぎると、自分のニーズを満たせない",
    "完璧はいつまで経っても訪れない",
    "自分独自の価値を貫いていく",
    "今後の自分に期待する",
    "恐怖をモチベーションにしない"
];

function changeQuote() {
    const randomIndex =
        Math.floor(Math.random() * quotes.length);

    document.getElementById(
        "random-quote"
    ).textContent = quotes[randomIndex];
}

changeQuote();

setInterval(
    changeQuote,
    5000
);