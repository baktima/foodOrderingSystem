#include <stdio.h>
#include <stdlib.h>

int PhoneNumber;
int option;
char filename[30]="";
char name[30];
void change_contact();
void create_contact();
void read_contact();



int main()
{
    /*printf("1. Create a contact\n2. change a contact\nchoose: ");
    scanf("%d", &option);
     if(option == 1){
        create_contact();
     }
     else if(option == 2) {
        change_contact();
     }
     else {
        printf("syntax error");
     }
     */
     /*printf("enter your desired contact to read name1_name2.txt: ");
     scanf("%s", &filename);
     FILE * fread = fopen(filename, "r");
        if(fread == NULL)
            {
            printf("\n%s\"file not found!", filename);
            exit(1);
            }

        else {
            fgets(filename, 30, fread);
            printf("%s", filename);
        }*/
      //extern int b;
      //printf("%d", b);
      int n;
      printf("enter your number here");
      scanf("%d", &n);
      for(int i = -n; i <= 1 < n; i++ ){
        printf("%d ", i);
      }

    return 0;
}

void change_contact(){
    char FilesName;
    printf("enter your files name: ");
    scanf("%s", FilesName);
    FILE * fchange = fopen("student_phone_number.txt", "w");
    printf("enter your name: ");
    scanf("%s", &name);
    printf("enter your phone number: ");
    scanf("%d", &PhoneNumber);
    fprintf(fchange, "%d", PhoneNumber);

}
void create_contact()
{
    printf("first name_second name.txt \nenter your name here: ");
    scanf("%s", &name);
    FILE * fnew = fopen(name, "w");
    printf("enter your phone number: ");
    scanf("%d", &PhoneNumber);
    fprintf(fnew,"%d", PhoneNumber);



}



