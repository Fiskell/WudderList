while true; do
  clear;
  if which -s cowsay && which -s lolcat; then
    php wunder.php | cowsay | lolcat;
  elif which -s cowsay; then
    php wunder.php | cowsay;
  elif which -s lolcat; then
    php wunder.php | lolcat;
  else 
    php wunder.php;
  fi
  sleep 10;
done
