//
//  ILTDetailViewController.m
//  iLiftTec
//
//  Created by Ivan Diaz on 3/23/14.
//  Copyright (c) 2014 Ivan Diaz. All rights reserved.
//

#import "ILTDetailViewController.h"
#import "SBJson.h"
#import "ILTDetailViewController.h"

#define kBgQueue dispatch_get_global_queue(DISPATCH_QUEUE_PRIORITY_DEFAULT, 0) //1

@interface ILTDetailViewController ()
- (void)configureView;
@end

@implementation ILTDetailViewController

#pragma mark - Managing the detail item

- (void)setDetailItem:(id)newDetailItem
{
    if (_detailItem != newDetailItem) {
        _detailItem = newDetailItem;
        
        // Update the view.
        [self configureView];
    }
}

-(void)setAvance:(NSMutableDictionary *)avance {
    if (_avance != avance) {
        _avance = avance;
        
        // Update the view.
        [self configureView];
    }
}

- (void)configureView
{
    // Update the user interface for the detail item.

    if (self.avance) {
        self.comentariosTV.text = self.avance[@"comentarios"];
    }
    
}

- (void)viewDidLoad
{
    [super viewDidLoad];
    
	// Do any additional setup after loading the view, typically from a nib.
    
    /*NSURLRequest *request = [NSURLRequest requestWithURL:[NSURL
                                                         URLWithString:@"http://localhost/rutinas.js"]];
    NSData *response = [NSURLConnection sendSynchronousRequest:request
                                             returningResponse:nil error:nil];
    
    NSError *jsonParsingError = nil;
    NSArray *publicTimeline = [NSJSONSerialization JSONObjectWithData:response options:0 error:&jsonParsingError];
    NSDictionary *dias;
    for (int i=0; i < [publicTimeline count]; i++) {
        
        	dias= [publicTimeline objectAtIndex:i];
        NSLog(@"Dia %.2i - Ejercicio  - %@", i+1, [[dias objectForKey:@"dias"] objectForKey:@"ejercicio"] );
        NSLog(@"        - Series - %@ \n\n", [[dias objectForKey:@"dias"] objectForKey:@"series"] );
        NSLog(@"        - Repeticiones - %@ \n\n", [[dias objectForKey:@"dias"] objectForKey:@"repeticiones"] );
        NSLog(@"        - Peso Inicial - %@ \n\n", [dias objectForKey:@"peso_incial"]);

        

    }*/

    [self configureView];
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

- (void)touchesBegan:(NSSet *)touches withEvent:(UIEvent *)event {
    
    [[self view] endEditing:TRUE];
    
}

/*- (void)fetchedData:(NSData *)responseData {
    //parse out the json data
    NSError* error;
    NSDictionary* json = [NSJSONSerialization
                          JSONObjectWithData:responseData //1
                          
                          options:kNilOptions
                          error:&error];
    
    NSArray* dias = [json objectForKey:@"dias"]; //2
    
    NSLog(@"dias: %@", dias); //3
    
    // 1) Get the latest loan
    NSDictionary* dia = [dias objectAtIndex:0];
    
    // 2) Get the funded amount and loan amount
    NSNumber* ejercicio = dia[@"ejercicio"];
    NSNumber* repeticiones = [dia objectForKey:@"repeticiones"];
    NSNumber* series = [dia objectForKey:@"series"];

    
    // 3) Set the label appropriately
    self.ejercicioLabel.text = [NSString stringWithFormat:@"Ejercicio: %@", [dia objectForKey:@"ejercicio"]];
}*/

- (IBAction)butonEnviar:(id)sender {
    self.avance[@"comentarios"] = self.comentariosTV.text;
    [self writeFileToDisk:self.avance];
    [self.navigationController popViewControllerAnimated:YES];
    
}

-(void)writeFileToDisk:(id)stuff
{
    NSArray *path = NSSearchPathForDirectoriesInDomains(NSDocumentDirectory, NSUserDomainMask, YES);
    NSString *documentDirPath = [path objectAtIndex:0];
    NSString *fileName = @"TEST";
    
    NSString *fileAndPath = [documentDirPath stringByAppendingPathComponent:fileName];
    
    [stuff writeToFile:fileAndPath atomically:YES];
}
@end
