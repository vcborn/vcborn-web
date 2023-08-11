const validate = function () {
  let flag = true;

  removeElementsByClass("error");
  removeClass("error-form");

  // お名前の入力をチェック
  if (!document.form.name.value) {
    errorElement(document.form.name, "お名前を入力してください");
    flag = false;
  }

  // ふりがなの入力をチェック
  if (!document.form.furigana.value) {
    errorElement(document.form.furigana, "ふりがなを入力してください");
    flag = false;
  } else if (!validateKana(document.form.furigana.value)) {
    // ふりがなの形式をチェック
    errorElement(document.form.furigana, "ひらがなのみで入力してください");
    flag = false;
  }

  // メールアドレスの入力をチェック
  if (!document.form.email.value) {
    errorElement(document.form.email, "メールアドレスを入力してください");
    flag = false;
  } else if (!validateMail(document.form.email.value)) {
    // メールアドレスの形式をチェック
    errorElement(document.form.email, "メールアドレスが正しくありません");
    flag = false;
  } else if (isWrongDomain(document.form.email.value)) {
    errorElement(document.form.email, "有効なメールアドレスを入力してください");
    flag = false;
  }

  // お問い合わせ項目の選択をチェック
  if (!document.form.item.value) {
    errorElement(document.form.item, "お問い合わせ項目を選択してください");
    flag = false;
  }

  // お問い合わせ内容の入力をチェック
  if (!document.form.content.value) {
    errorElement(document.form.content, "お問い合わせ内容を入力してください");
    flag = false;
  }

  // プライバシーポリシーに同意したか
  if (!document.form.agree.checked) {
    flag = false;
  }

  if (flag) {
    document.forms.form.submit();
  } else {
    return false;
  }
};

const errorElement = function (form, msg) {
  form.classList.add = "error-form";
  const newElement = document.createElement("div");
  newElement.className = "error";
  const newText = document.createTextNode(msg);
  newElement.appendChild(newText);
  form.parentNode.insertBefore(newElement, form.nextSibling);
};

const removeElementsByClass = function (className) {
  const elements = document.getElementsByClassName(className);
  while (elements.length > 0) {
    elements[0].parentNode.removeChild(elements[0]);
  }
};

const removeClass = function (className) {
  const elements = document.getElementsByClassName(className);
  while (elements.length > 0) {
    elements[0].classList.remove(className);
  }
};

// RFC2822に則ったチェック
const validateMail = function (val) {
  const mailformat =
    /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;
  return mailformat.test(val);
};

// サンプルドメインや捨てメアドでないか
const isWrongDomain = function(val) {
  const emailDomain = val.split('@')[1];
  const exampleDomain = ["example.com", "example.net", "google.com", "ad.com", "ad.net", "instaddr.ch", "lovelycats.org", "ccmail.uk", "xmailer.be", "na-cat.com", "exdonuts.com", "cocoro.uk", "hamham.uk", "mama3.org", "digdig.org", "fukurou.ch", "nezumi.be", "owleyes.ch", "stayhome.li", "okinawa.li", "fanclub.pm", "nekochan.fr", "hotsoup.be", "sofia.re", "simaenaga.com", "tapi.re", "kagi.be", "nagi.be", "fuwari.be", "magim.be", "mirai.re", "moimoi.re", "heisei.be", "honeys.be", "mbox.re", "uma3.be", "fuwa.li", "kpost.be", "risu.be", "fuwa.be", "usako.net", "eay.jp", "via.tokyo.jp", "ichigo.me", "choco.la", "cream.pink", "merry.pink", "neko2.net", "fuwamofu.com", "ruru.be", "macr2.com", "f5.si", "ahk.jp", "svk.jp"];
  return exampleDomain.includes(emailDomain);
};

const validateKana = function (val) {
  return val.match(/^[ぁ-ん]|-|ー+$/);
};
