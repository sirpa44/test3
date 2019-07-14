# Question Api

### Install

clone the git repo on your own host

```bash
$ git clone https://github.com/sirpa44/test3.git
```

dependency

```bash
$ conposer install
```

###CSV or JSON file

put your Data file in oat_test/Data .

```bash
oat_test/Data
```

create a .env.local file

```
csv_data="questions.csv"
json_data="questions.json"
```

####CSV

in oat_test/config/services.yaml

```yaml
services:
    App\Repository\QuestionRepository:
        arguments:
            - '@App\Adapter\CsvManager'

```

####Json

in oat_test/config/services.yaml

```yaml
services:
    App\Repository\QuestionRepository:
        arguments:
            - '@App\Adapter\JsonManager'

```