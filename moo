if [ $# -eq 0 ]; then
  clear;
  echo "Please run command with a valid list_id\n";
  php wunder.php list;
  exit;
fi

while true; do
  clear;
  if which -s cowsay && which -s lolcat; then
    php wunder.php $1 | cowsay | lolcat;
  elif which -s cowsay; then
    php wunder.php $1 | cowsay;
  elif which -s lolcat; then
    php wunder.php $1 | lolcat;
  else 
    php wunder.php $1;
  fi
  sleep 10;
done
