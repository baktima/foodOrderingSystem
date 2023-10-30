#include <stdio.h>
#include <stdlib.h>
#include <limits.h>

void degree();
void length();

int main()
{
   /* int converter;
    printf("1. degree\n2. length\n");
    printf("Please select your desired converter: ");
    scanf("%d", &converter);
    if (converter == 1){
        degree();
    }
    else if(converter == 2){
        length();
    }
    else {
        printf("syntax error");
    }*/
     float A = 0, B = 0;
    float i, j;
    int k;
    float z[1760];
    char b[1760];
    printf("\x1b[2J");
    for(;;) {
        memset(b,32,1760);
        memset(z,0,7040);
        for(j=0; j < 6.28; j += 0.07) {
            for(i=0; i < 6.28; i += 0.02) {
                float c = sin(i);
                float d = cos(j);
                float e = sin(A);
                float f = sin(j);
                float g = cos(A);
                float h = d + 2;
                float D = 1 / (c * h * e + f * g + 5);
                float l = cos(i);
                float m = cos(B);
                float n = sin(B);
                float t = c * h * g - f * e;
                int x = 40 + 30 * D * (l * h * m - t * n);
                int y= 12 + 15 * D * (l * h * n + t * m);
                int o = x + 80 * y;
                int N = 8 * ((f * e - c * d * g) * m - c * d * e - f * g - l * d * n);
                if(22 > y && y > 0 && x > 0 && 80 > x && D > z[o]) {
                    z[o] = D;
                    b[o] = ".,-~:;=!*#$@"[N > 0 ? N : 0];
                }
            }
        }
        printf("\x1b[H");
        for(k = 0; k < 1761; k++) {
            putchar(k % 80 ? b[k] : 10);
            A += 0.00004;
            B += 0.00002;
        }
        usleep(30000);
    }
    return 0;
}
void degree()
{
    int Innitial_degree;
    int amount;
    int desired_degree;
    printf("1 = Celsius\n2 = Farenheit\n3 = Kelvin\n");
    printf("enter your initial degree in number: ");
    scanf("%d", &Innitial_degree);
    printf("enter enter the amount: ");
    scanf("%d", &amount);
    printf("enter your desired degree in number: ");
    scanf("%d", &desired_degree);

    if(Innitial_degree == 1) {
        if(desired_degree == 2){
            printf("%d Farenheit", amount * 9/5 + 32);
        }
        else if(desired_degree == 3) {
            printf("%d Kelvin", amount + 273);
        }
        else {
            printf("syntax error, please try again !");
        }
    }
    else if(Innitial_degree == 2){
         if(desired_degree == 1){
            printf("%d celsius", (amount - 32) * 5/9);
        }
        else if(desired_degree == 3) {
            printf("%d Kelvin", (amount - 32) * 5/9 + 273 );
        }
        else {
            printf("syntax error, please try again !");
        }

    }
     else if(Innitial_degree == 3){
         if(desired_degree == 1){
            printf("%d celsius", amount - 273);
        }
        else if(desired_degree == 2) {
            printf("%d farenheit", (amount - 273) * 9/5 + 32 );
        }
        else {
            printf("syntax error, please try again !");
        }

    }
     else {
        printf(" syntax error");
    }
}

void length()
{

    int SelectedNumber;
    int SelectedMeter;
    unsigned int MeterToKilloMeter;
    unsigned int MeterToMilliMeter;

    printf("1. Meter\n2. KilloMeter\n3. Millimeter\nEnter your selected Number: ");
    scanf("%d", &SelectedNumber);
    if (SelectedNumber == 1) {
        printf("1. KilloMeter\n2. Millimeter\nenter your designated length: ");
        scanf("%d", &SelectedMeter);
        if ( SelectedMeter == 1){
           printf("Enter your length: ");
           scanf("%u", &MeterToKilloMeter);
           printf("%u Km", MeterToKilloMeter / 1000);
        }
        else if ( SelectedMeter == 2){
           printf("Enter your length: ");
           scanf("%u", &MeterToMilliMeter);
           printf("%u mm", MeterToMilliMeter* 1000);
        }
        else {
            printf("syntax error please try again");
        }
    }
}
