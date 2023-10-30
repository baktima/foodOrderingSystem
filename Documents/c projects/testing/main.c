#include <stdio.h>
#include <stdlib.h>


struct Node{
    int data;
    struct Node* next;

};

struct Node* head; //global variable, can be accessed anywhere

void insert(int x)
{
    struct Node* temp = (struct Node*)malloc(sizeof(struct Node));
    temp ->data = x; // bisa juga pake (*temp).data = x ;
    temp ->next = head; // ini dereferencing jadi buat isi datanya
    head = temp;  // gak ada pake pointer jadi headnya itu nunjuk ke memory address di temp

}
void print()
{
    struct Node* temp = head;
    printf("list is: ");
    while(temp != NULL)
        {
        printf("%d ", temp -> data);
        temp = temp -> next;
    }
}

int main(){
    head = NULL;//creating the empty list
    printf("How many numbers: ");
    int i, n, x;
    scanf("%d", &n);
    for(i = 0; i < n; i++){
        printf("\n enter the number:  ");
        scanf("%d", &x);
        insert(x);
        print();
        }



}




/*void create();
void DataInput();
void ReadData();
void DeleteData();
int i = 3;


int main()
{
    DeleteData();

 return 0;
}

void create()

{
    if (i < 9 ){
    FILE * Fa = fopen("wassap.txt", "a");
    char name[100];
    char gmail[100];
    double PhoneNumber;
    printf("enter your name: ");
    gets(name);
    printf("enter your gmail: ");
    gets(gmail);
    printf("enter your phone number: ");
    scanf("%lf", &PhoneNumber);
    fprintf(Fa, "%s %s %f", name, gmail, PhoneNumber);
    i++;
    }
    else {
        printf("system maximum capacity");
    }

}


void DataInput()
{
    FILE * Fa = fopen("wassap.txt", "w");
    char name[100];
    char gmail[100];
    double PhoneNumber;
    printf("enter your name: ");
    gets(name);
    printf("enter your gmail: ");
    gets(gmail);
    printf("enter your phone number: ");
    scanf("%lf", &PhoneNumber);
    fprintf(Fa, "%s %s %f", name, gmail, PhoneNumber);
}

void ReadData()
{


    char name[100],name2[100],gmail[100];
    double PhoneNumber;
    int i;
    FILE * Fa = fopen("wassap.txt", "r");
    while(fscanf(Fa,"%s %s %s %lf",name, name2,gmail,&PhoneNumber)!=EOF){

			printf("------------------------------------------\n");
		printf("Name:%s %s\n",name, name2);
		printf("Gmail:%s\n",gmail);
		printf("Phone:%lf\n", PhoneNumber);


				printf("------------------------------------------");
				printf("\n\n");
		}

       }
void DeleteData() {

    char name[100],name2[100],gmail[100];
    char EnteredName[100], EnteredName2[100];
    int empty = " ";
    double PhoneNumber;
    int i;
    FILE * Fa = fopen("wassap.txt", "w");
    while(fscanf(Fa,"%s %s %s %lf",name, name2,gmail,&PhoneNumber)!=EOF){
            printf("enter your first name: ");
            scanf("%s", &EnteredName);
            printf("enter your second name: ");
            scanf("%s", &EnteredName2);
            if(EnteredName == name && EnteredName2 == name2){

                fprintf(Fa,"%d", empty);
            }
             else {

                printf("there is no such name, please retry");

            }


    }
}
*/











